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

use Illuminate\Support\Facades\DB;
use mysqli;

class ResultProcessingController extends Controller
{
    public function __construct()
    {
        $this->middleware('EO');
    }
    public function index()
    {

        return  view('results.index');
    }
    public function process(Request $request)
    {
        //dd("here");
        //$request->validate();
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
                ->with('registration', function ($query) use ($session, $semesters, $sem) {
                    return $query->where(['SESSION' => $session, 'SEMESTER' => $semesters[$sem - 1]]);
                })->get();
            $table = SemesterViewService::generateTable(
                $students,
                $prog_id,
                Str::endsWith($type, "-1"),
                $sem,
                $session
            );
            return view('results.semester')->withTable($table);
        } else {

            $studentsWithReg = Student::select(['FIRST_NAME', 'MIDDLE_NAME', 'LAST_NAME', 'CURRENT_LEVEL', 'REG_NUMBER'])
                ->where(['PROG_ID' => $prog_id, 'CURRENT_LEVEL' => $level, 'REGNO_STATUS' => 1])
                ->whereHas('registration')->with('registration')->get();
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
                $studentsWithReg,
                $courses,
                Str::endsWith($type, "-1"),
                Programme::where('PROG_ID', $prog_id)->first()
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
}