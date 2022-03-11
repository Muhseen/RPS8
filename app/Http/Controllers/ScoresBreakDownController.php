<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\ScoresBreakDown;
use Illuminate\Http\Request;

class ScoresBreakDownController extends Controller
{
    public function index()
    {
        $courses = ScoresBreakDown::where('dept_id', auth()->user()->staff->dept_id)->with('course')->get();
        return view('scoresBreakDown.index')->withSbr($courses);
    }


    public function show($id)
    {
        $course = Course::find($id);
        $scoresBreakDown = ScoresBreakDown::where('course_id', $id)->with('course')->first();

        if ($scoresBreakDown == null) {
            $scoresBreakDown =   new ScoresBreakDown();;
            $scoresBreakDown->test1Score = 10;
            $scoresBreakDown->test2Score = 10;
            $scoresBreakDown->assignment1Score = 10;
            $scoresBreakDown->asignment2Score = 10;
            $scoresBreakDown->examination = 60;
            $scoresBreakDown->practicalScore = 0;
            $scoresBreakDown->practical_count = 0;
            $scoresBreakDown->practical_type = "NA";
        }

        //dd($scoresBreakDown, $course);
        return view('scoresBreakDown.setScoreBreakDown')
            ->withSbr($scoresBreakDown)
            ->withCourse($course);
    }

    public function edit(ScoresBreakDown $scoresBreakDown)
    {
        //
    }

    public function update(Request $request, ScoresBreakDown $scoresBreakDown)
    {
        $attr = $request->validate([
            'course_id' => 'required', 'test1Score' => 'required', 'test2Score' => 'required', 'assignment1Score' => 'required', 'assignment2Score' => 'required',
            'examination' => 'required', 'practicalScore' => 'required', 'practical_count' => 'required'
        ]);
        $sum = $request->test1Score + $request->test2Score + $request->assignment1Score + $request->assignment2Score + $request->examination + $request->practicalScore;
        if ($sum != 100) {
            return back()->withErrors('Sum of scores does not tally');
        }
        $attr = array_merge($attr, ['dept_id' => auth()->user()->staff->dept_id]);
        ScoresBreakDown::upsert($attr, ['course_id']);
        session()->flash('message', 'Succesfully Set breakdown for The course');
        return redirect('/scoresBreakDown');
    }

    public function destroy(ScoresBreakDown $scoresBreakDown)
    {
        $scoresBreakDown->delete();
        session()->flash('success', 'Breakdown successfull deleted! The default will be applied henceforth');
    }
}