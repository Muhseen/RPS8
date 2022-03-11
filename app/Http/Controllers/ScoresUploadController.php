<?php

namespace App\Http\Controllers;

use App\Events\ScoresUploadedEvent;
use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Grades;
use App\Models\Programme;
use App\Services\GradesServices\GradesServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\ScoresBreakDown;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ScoresImport;
use App\Models\ClassAllocation;

class ScoresUploadController extends Controller
{
    public function index($type)
    {
        $types = [
            'firstCA' => 'First C.A',
            'secondCA' => 'Second C.A',
            'firstAssignment' => 'First Assignment',
            'secondAssignment' => 'Second Assignment',
            'examination' => 'Examination'
        ];
        session()->put('scoreType', Str::lower($types[$type]));
        return view('scoresUpload.index')->withScoreType($types[$type]);
    }
    public function upload(Request $request)
    {
        DB::beginTransaction();
        //if Examination
        if (session('scoreType') == "examination") {
            if (!ClassAllocation::where(
                [
                    'session' => $request->session,
                    'semester' => $request->semester,
                    'course_id' => $request->course_id
                ]
            )->first()->isLeadLec) {
                return back()->withErrors('Only Lead Lecturers can upload examination scores for a course');
            }
        }
        $type = Str::lower($request->type);
        if ($type != session('scoreType')) {
            return back()->withErrors('Scores to being uploaded do not match the submitted expected score type');
        }
        $now = time();
        request()->validate([
            'scoresFile' => 'required|mimes:xlsx,xls,csv'
        ]);

        $semester = $request->semester;
        $session = $request->session;
        $course = Course::where('course_id', $request->course_id)->first();
        $prog = Programme::where('prog_id', $request->prog_id)->first();
        $workbook = Excel::toCollection(new Scoresimport, $request->scoresFile); // $request->file('scoresFile')); //_FILES["scoresFile"]["tmp_name"]);
        $sheet = $workbook[0];
        $semesters = ['First', 'Second'];
        $reg = CourseRegistration::where([
            'SEMESTER' => $semesters[$semester - 1],
            'SESSION' => $session,
            'COURSE_ID' => $course->COURSE_ID,
            'PROG_ID' => $prog->PROG_ID
        ])->get();
        $ids = $reg->pluck('SN');
        $id = "";
        for ($i = 0; $i < count($ids); $i++) {
            $id .= $ids[$i] . ',';
        }
        $id = substr($id, 0, (strlen($id) - 1));
        $sql = "delete from course_registrations where SN in($id)";
        //dd($sql);
        DB::delete($sql);
        $sbr = ScoresBreakDown::where('course_id', $course->COURSE_ID)->first();
        if ($sbr == null) {
            $sbr = new ScoresBreakdown();
            $sbr->test1Score = 10;
            $sbr->test2Score = 10;
            $sbr->assignment1Score = 10;
            $sbr->assignment2Score = 10;
            $sbr->practical_count = 0;
            $sbr->practicalScore = 0;
            $sbr->examination = 60;
        } //s}
        try {
            $query = "insert into course_registrations(SN,REG_NUMBER, COURSE_ID,SEMESTER, LEVEL, SESSION, YEAR, PROG_ID, REG_TYPE,  test1score,test2score,assignment1Score, assignment2Score, practical1Score, examination, grade, gradePoints) values ";
            $indices = ['first c.a' => 0, 'second c.a' => 1, 'first assignment' => 2, 'second assignment' => 3, 'practical1Score' => 4, 'examination' => 5];
            $columns = ['test1Score', 'test2Score', 'assignment1Score', 'assignment2Score', 'practicalScore', 'examination'];
            $excelIndex = [3, 4, 5, 6, 7, 10];
            $index = $indices[Str::lower(session('scoreType'))];
            foreach ($reg as $r) {
                foreach ($sheet as $row) {
                    if (Str::lower($r->REG_NUMBER) == Str::lower($row[1])) { {
                            $score = $row[$excelIndex[$index]];
                            $col = $columns[$index];

                            if ($type == "examination") {
                                $score = ($score / 100) * $sbr->$col;
                                // dd($score, $col, $index, $type, $score);
                            }

                            $r->$col = ($score < 0 || $score > $sbr->$col) ? 0 : $score;
                        }
                        $r->grade = GradesServices::computeGrade($r->total);
                        $r->gradePoints = $course->CREDIT_UNITS * GradesServices::computePoints($r->total);
                        //dd(GradesServices::computeGrade($r->total), $r, $sbr->$col, $row[$excelIndex[$index]], $r->REG_NUMBER, $course->CREDIT_UNITS);
                        $query .= "('$r->SN','$r->REG_NUMBER','$r->COURSE_ID','$r->SEMESTER','$r->LEVEL','$r->SESSION','$r->YEAR','$r->PROG_ID','$r->REG_TYPE','$r->test1Score','$r->test2Score','$r->assignment1Score','$r->assignment2Score','$r->practical1Score', '$r->examination','$r->grade','$r->gradePoints') ,";
                    }
                }
            }
            $query = substr($query, 0, (strlen($query) - 1));
            $query .= ";";
            //dd($query);
            DB::insert($query);
            DB::commit();
            event(ScoresUploadedEvent::class);
            $filepath = "/scoresUpload/" . $prog->department->DEPARTMENT . "/" . $prog->PROG_TYPE . "/" . str_replace("_", "/", $session) . "/" . $semester . "/" . $type;
            $request->file("scoresFile")->storeAs($filepath, $request->file('scoresFile')->getClientOriginalName() . str_replace(":", "_", now()) . "." . $request->file('scoresFile')->extension());
            session()->flash('message', "Succesfully uplaoded in " . time() - $now . " second(s)");
            return redirect()->back();
            //dd("commit", time() - $now);
        } catch (\Exception $e) {
            //dd($e);
            DB::rollBack();
            return back()->withErrors($e);
        }
    }
}