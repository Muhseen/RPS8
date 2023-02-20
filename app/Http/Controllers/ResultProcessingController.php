<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Student;
use App\Services\ResultsServices\ContinuousViewService;
use App\Services\ResultsServices\SemesterViewService;
use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Programme;
use App\Http\Requests\ProcessResultRequest;
use App\Models\ResultAnalysisData;
use Exception;
use Illuminate\Support\Facades\DB;
use mysqli;

class ResultProcessingController extends Controller
{
    public  $allGrades;
    public function __construct()
    {
        $this->allGrades = ["AA", "A", "AB", "B", "BC", "C", "CD", "D", "E", "F", "AE", "AW", "PC", "NA", "OP", "EM", "NR", "SK", "CP", "DE", "DF"];
        $this->middleware('EO');
    }
    public function index()
    {

        return  view('results.index');
    }
    public function process(ProcessResultRequest  $request)
    {
        $start = memory_get_usage();
        $grades = array('A', 'AB', 'B', 'BC', 'C', 'CD', 'D', 'DE', 'E', 'EF', 'F', 'AW', 'AE');
        $level = $request->level;
        $prog_id = $request->prog_id;
        $session = $request->session;
        $sem = $request->semester;
        $semesters = ['FIRST', 'SECOND'];
        $type = $request->type;
        if (Str::startsWith($type, "semester")) {

            $students = Student::select(['FIRST_NAME', 'MIDDLE_NAME', 'LAST_NAME', 'CURRENT_LEVEL', 'REG_NUMBER'])
                ->where(['PROG_ID' => $prog_id, 'CURRENT_LEVEL' => $level, 'REGNO_STATUS' => 1])
                ->whereHas('registration', function ($query) use ($session, $semesters, $sem) {
                    return $query->where(['SESSION' => $session, 'SEMESTER' => $semesters[$sem - 1]]);
                })
                ->with('registration', function ($query) use ($session, $semesters, $sem) {
                    return $query->where(['SESSION' => $session, 'SEMESTER' => $semesters[$sem - 1]]);
                })->get();

            //$students  = Student::with('registration')->get();
            if ($students->count() == 0) {;
                return back()->withErrors("No Students with the specified criteria or No Student Has registered for selected Criteria");
            }

            $stats = CourseRegistration::where(['SESSION' => $session, 'SEMESTER' => $semesters[$sem - 1], 'PROG_ID' => $prog_id, 'LEVEL' => $level])->with('course')->get();
            $sTable = "<table class='table table-boredered table-striped'><tr><th>Course</th> <th>COURSE CODE</th>";
            for ($i = 0; $i < count($this->allGrades); $i++) {
                $sTable .= "<th>" . $this->allGrades[$i] . "</th>";
            }
            $sTable .= "<th>Total</th><th>Mean</th><th>STD DEV</th><th>% Pass</th> ";
            $statsByCourse = $stats->groupBy('COURSE_ID');
            foreach ($statsByCourse as $sc) {
                $analysis = ResultAnalysisData::where(['session' => $session, 'course_id' => $sc->first()->course->COURSE_ID])->first();
                $sTable .= "<tr><th>" . $sc->first()->course->COURSE_NAME . "</th><th>" . $sc->first()->course->COURSE_CODE . "</th>";
                for ($i = 0; $i < count($this->allGrades); $i++) {
                    $sTable .= "<th>" . $sc->where('grade', $this->allGrades[$i])->count() . " </th>";
                }
                $sTable .= "<th>" . $sc->count() . "</th><th>" . $this->formatPoints($analysis->mean) . "</th><th>" . $this->formatPoints($analysis->standardDev) . "</th> <th>100</th>";
                $sTable .= "</tr>";
            }
            $sTable .= "</table>";

            //dd($sTable);
            $table = SemesterViewService::generateTable(
                $request,
                $students,
                $prog_id,
                Str::endsWith($type, "-1"),
                $sem,
                $session
            );
            return view('results.semester')->withTable($table)->withSTable($sTable);
        } else {
            $studentsWithReg = Student::select(['FIRST_NAME', 'MIDDLE_NAME', 'LAST_NAME', 'CURRENT_LEVEL', 'REG_NUMBER'])
                ->where(['PROG_ID' => $prog_id, 'CURRENT_LEVEL' => $level, 'REGNO_STATUS' => 1])
                ->whereHas('registration')->with('registration')->get();
            if ($studentsWithReg->count() == 0) {
                return back()->withErrors("No students with the specified criteria");
            }
            $count = CourseRegistration::whereIn('REG_NUMBER', $studentsWithReg->pluck('REG_NUMBER'))
                ->select(DB::raw("count(distinct semester, session) as count"))->get()[0]['count'];
            $programme = Programme::where('PROG_ID', $prog_id)->first();
            $courses = Course::query();
            $courses->where('PROG_ID', $prog_id);
            if ($count >= 1) {
                $courses->where(
                    function ($query) use ($programme) {
                        $query->where('LEVEL', $programme->ENTRY_LEVEL);
                        $query->where('SEMESTER', 'FIRST');
                    }
                );
            }
            if ($count >= 2) {
                $courses->where(
                    function ($query) use ($programme) {
                        $query->where('LEVEL', $programme->ENTRY_LEVEL);
                        $query->where('SEMESTER', 'SECOND');
                    }
                );
            }
            if ($count >= 3) {
                $courses->where(
                    function ($query) use ($programme) {
                        $query->where('LEVEL', ($programme->ENTRY_LEVEL + 100));
                        $query->where('SEMESTER', 'FIRST');
                    }
                );
            }
            if ($count >= 4) {
                $courses->where(
                    function ($query) use ($programme) {
                        $query->where('LEVEL', ($programme->ENTRY_LEVEL + 100));
                        $query->where('SEMESTER', 'SECOND   ');
                    }
                );
            }
            $courses = $courses->get();
            $table = ContinuousViewService::generateResults(
                $request,
                $studentsWithReg,
                $courses,
                Str::endsWith($type, "-1"),
                Programme::where('PROG_ID', $prog_id)->with(['department', 'college', 'school'])->first()
            );
            return view('results.semester')->withTable($table);
        }

        /*$regnos = array();s
        $regnoss = DB::table('students')->where(['level' => $level, 'dept' => $dept])->select('regno')->get();

        foreach ($regnoss as $s) {
            array_push($regnos, $s->regno);
        }*/
        /*$distinctCourses = Course::where(['semester' => $sem, 'level' => $level])->get();
        if (Str::startsWith($type, "semester")) {
            $regsem = $level == "200" || $level == "400" ? ($sem + 2) : $sem;
            $reg = CourseRegistration::whereIn('grade', $grades)->whereIn('regno', $regnos)->where(['semester' => $sem, 'session' => $session])->get(); //DB::table('regs')->orderBy('regs.regno', 'asc')->orderBy('coursecode', 'asc')->leftjoin('students', 'regs.regno', 'students.regno')->get(); //processedReg::orderBy('regno','asc')->orderBy('courseCode','asc')->get();
            $prevRegs = reg::whereIn('regno', $regnos)->where('semester', '<', $sem)->where('session', $session)->get(); //DB::table('regs')->orderBy('regs.regno', 'asc')->orderBy('coursecode', 'asc')->leftjoin('students', 'regs.regno', 'students.regno')->get(); //processedReg::orderBy('regno','asc')->orderBy('courseCode','asc')->get();
            $prevRegs = $prevRegs->groupBy('regno');
            $reg = $reg->groupby('regno');
            $table = ResultProcessor::processSemesterResult($reg, $distinctCourses, $students, $regsem, $prevRegs, Str::endsWith($type, "-1"));
            return view('results.dept')->withTable($table);
        } else { //if (Str::startsWith($type,"continuos")) {

            $reg = reg::whereIn('grade', $grades)->whereIn('regno', $regnos)->get(); //DB::table('regs')->orderBy('regs.regno', 'asc')->orderBy('coursecode', 'asc')->leftjoin('students', 'regs.regno', 'students.regno')->get(); //processedReg::orderBy('regno','asc')->orderBy('courseCode','asc')->get();
            $courses = $reg->pluck('courseCode')->unique();
            $semesters = $reg->pluck('semester')->unique();
            //dd("here",$reg, $courses,$semesters);
            $table = ResultProcessor::ProcessContinuousResult($reg, $courses, $students, $semesters, Str::endsWith($type, "-1"));
            return view('results.dept')->withTable($table);
            }*/
    }
    public function formatPoints($number)
    {
        return number_format($number, 2, ".", "");
    }
}
