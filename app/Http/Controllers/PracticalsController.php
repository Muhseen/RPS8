<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Models\ScoresBreakDown;
use App\Models\PracticalScores;
use App\Models\Programme;
use App\Imports\ScoresImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\CourseRegistration;
use Illuminate\Support\Facades\DB;

class PracticalsController extends Controller
{
    public function getPracticalsConducted(Request $request)
    {
        $course_id = $request->course_id;
        $session = $request->session;
        $semester = $request->semester;
        $prog_id = $request->prog_id;
        $cbr =  ScoresBreakDown::where(['course_id' => $course_id])->first();
        if ($cbr == null) {
            session()->flash('error', 'This Course does not have practical set by the Department. Check The Course code again. if it\'s correct , Please Contact your HOD to set the details for the course');
            return ['practical_count' => 'NIL'];
        } else {
            $practicals = PracticalScores::where(['course_id' => $course_id, 'session' => $session])->pluck('practicalNo');
            $practicals = $practicals->unique();
            $val = array('count' => $cbr->practical_count, 'conducted' => json_encode($practicals));
            $vals = [];
            foreach ($practicals as $p) {
                array_push($vals, $p);
            }
            //dd($vals);
            //dd(array_column($practicals->toArray(), 1));
            return ['practical_count' => count($practicals), 'expected' => $cbr->practical_count, 'practicals' => $vals];
        }
    }
    public function captureScores(Request $request)
    {
        DB::beginTransaction();
        //if Examination
        if (session('scoreType') != "practicals") {
            return back()->withErrors('Scores upload selection mismatch');
        }
        $course_id = $request->course_id;
        $prog_id = $request->prog_id;
        $prog = Programme::where('PROG_ID', $prog_id)->first();
        $course = Course::where('COURSE_ID', $course_id)->first();

        $now = time();
        request()->validate([
            'scoresFile' => 'required|mimes:xlsx,xls,csv',
            'course_id' => 'required',
            'prog_id' => 'required'
        ]);

        $semester = $request->semester;
        $session = $request->session;
        $workbook = Excel::toCollection(new Scoresimport, $request->scoresFile); // $request->file('scoresFile')); //_FILES["scoresFile"]["tmp_name"]);
        $sheet = $workbook[0];
        $semesters = ['First', 'Second'];
        $reg = CourseRegistration::where([
            'SEMESTER' => $semesters[$semester - 1],
            'SESSION' => $session,
            'COURSE_ID' => $course->COURSE_ID,
            'PROG_ID' => $prog->PROG_ID
        ])->get();
        $colIndex = $request->practicalNo + 2;
        DB::delete('delete from practical_scores where session =? and course_id = ? and practicalNo = ?', [$session, $course_id, $request->practicalNo]);
        foreach ($sheet as $row) {
            if ($row[1] != "" && $row[1] != "REG NUMBER") {
                //dd($row[1], $row[$colIndex], $colIndex);
                $pSE = new PracticalScores();
                $pSE->reg_number = $row[1];
                $pSE->session = $session;
                $pSE->semester = $semester;
                $pSE->course_id  = $course_id;
                $pSE->score = $row[$colIndex] ?? 0;
                $pSE->practicalNo = $request->practicalNo;
                $pSE->save();
            }
        }
        /*
        $cbr = ScoresBreakDown::where('course_id', $course_id)->first();
        if ($cbr->practical_type == "average") {
            $practicals = PracticalScores::where(['course_id' => $course_id, 'session' => $session])->pluck('practicalNo');
            $noofPrcaticals = count($practicals->unique());
            $scores = PracticalScores::where(['course_id' => $course_id, 'session' => $session])->select(DB::raw("SUM(score) as score"))->groupBy('reg_number')->get();
            dd($scores);
        }
  */      //*/
        /*

        */
        // if()
        DB::commit();
        session()->flash('message', 'Practical Score succesfully captured');

        return back();
        //dd($request->all(), gettype($sheet));
    }
}