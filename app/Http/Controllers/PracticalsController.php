<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Models\ScoresBreakDown;
use App\Models\PracticalScores;

class PracticalsController extends Controller
{
    public function getPracticalsConducted(Request $request)
    {
        $course_id = $request->course_id;
        $session = $request->session;
        $semester = $request->semester;
        $prog_id = $request->prog_id;
        $cbr =  ScoresBreakDown::where(['course_id' => $course_id, 'semester' => $semester, 'session' => $session, 'prog_id', $prog_id])->first();
        if ($cbr == null) {
            session()->flash('error', 'This Course does not have practical set by the Department. Check The Course code again. if it\'s correct , PLease Contact your HOD to set the details for the course');
            session('error', 'This Course does not have practical score set by the Department. Check The Course code again. if it\'s correct , PLease Contact your HOD to set the details for the course');
            return ['practical_count' => 'NIL'];
        } else {
            $practicals = PracticalScores::where('session', $session)->where('semester', $semester)->where('course_id', $course_id)->pluck('practicalNo');
            $practicals = $practicals->unique();
            $val = array('count' => $cbr->practicalCount, 'conducted' => json_encode($practicals));
            return ['practical_count' => 0];
        }
    }
}