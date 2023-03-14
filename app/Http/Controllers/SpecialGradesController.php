<?php

namespace App\Http\Controllers;

use App\Models\CourseRegistration;
use App\Models\Grades;
use App\Models\Programme;
use App\Services\GradesServices\GradesServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpecialGradesController extends Controller
{
    public function index()
    {
        $progs = Programme::where('dept_id', auth()->user()->staff->dept_id)->get();
        return view('results.speacialCases')
            ->withProgs($progs);
    }
    public function studentCase(Request $request)

    {


        $request->validate(['reg_number' => 'required|exists:students,REG_NUMBER', 'session' => 'required', 'grade' => 'required', 'course_id' => 'required']);
        $reg = CourseRegistration::where('REG_NUMBER', $request->reg_number)->where('COURSE_ID', $request->course_id)->whereSession($request->session)->first();
        $reg->grade = GradesServices::computeGrade(($request->grade));
        $reg->gradePoints = GradesServices::computePoints($request->grade);
        $reg->examination = $request->grade;
        $reg->save();
        session()->flash('message', 'Succesfully Processed Student Case');
        return back();
    }

    public function classCase(Request $request)
    {
        $request->validate(['session' => 'required', 'grade' => 'required', 'prog_id' => 'required', 'course_id' => 'required']);
        DB::beginTransaction();
        try {
            $regs = CourseRegistration::where('session', $request->session)->where('prog_id', $request->prog_id)->where('course_id', $request->course_id)->get();
            foreach ($regs as $reg) {
                $reg->grade = GradesServices::computeGrade($request->grade);
                $reg->gradePoints = GradesServices::computePoints($request->grade);
                $reg->examination = $request->grade;
                $reg->save();
                //     dd($reg->grade, $request->grade, GradesServices::computeGrade($request->grade), GradesServices::computePoints($request->grade));
            }
            session()->flash('message', 'Succesfully Processed Course case');
            DB::commit();

            return back();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors($e->getMessage());
        }
    }
}
