<?php

namespace App\Http\Controllers;

use App\Models\ClassAllocation;
use App\Models\Department;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Requests\ClassAllocationRequest;
use App\Models\Programme;
use Illuminate\Support\Facades\DB;

class ClassAllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('classAllocation.index')
            ->withAllocations(ClassAllocation::orderBy('file_no')->get());
    }
    public function create()
    {
        return view('classAllocation.create');
    }

    public function store(ClassAllocationRequest $request)
    {
        $attr = $request->validated();
        if ($request->has('isLeadLec')) {
            DB::update(
                'update class_allocations set isLeadLec =0 where session = ? and semester = ? and programme_type = ? and course_id = ?',
                [
                    $request->session, $request->semester,
                    $request->programme_type,
                    $request->course_id
                ]
            );
        }
        $attr = array_merge($attr, ['dept_id' => auth()->user()->staff->dept_id, 'added_by' => auth()->user()->file_no ?? 13283, 'isLeadLec' => $request->has('isLeadLec')]);
        ClassAllocation::create($attr);
        session()->flash('message', "Succesfully Allocated Course  to {$request->staff_name}");
        return redirect('/classAllocation');
    }
}