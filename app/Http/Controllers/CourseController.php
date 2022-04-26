<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUpdateCourse;
use App\Models\Course;
use App\Models\Programme;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dept_id = auth()->user()->staff->dept_id;
        $deptCourses = Course::with('programme')->where('DEPT_ID', $dept_id)->get();
        return view('courses.index')->withDeptCourses($deptCourses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dept_id = auth()->user()->staff->dept_id;
        $prog = Programme::where('DEPT_ID', $dept_id)->get();
        return view('courses.create')->withProgs($prog);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUpdateCourse $request)
    {
        $id = Course::max('COURSE_ID');
        $id += 1;
        $attr = $request->validated();
        $attr = array_merge($attr, ['DEPT_ID' => auth()->user()->staff->dept_id, 'COURSE_ID' => $id]);
        //dd($attr);
        Course::create($attr);
        session()->flash('message', 'Successfully aded course');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $dept_id = auth()->user()->staff->dept_id;

        $progs = Programme::where('DEPT_ID', $dept_id)->get();

        return view('courses.edit')->withCourse($course)->withProgs($progs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(CreateUpdateCourse $request, Course $course)
    {
        $attr = $request->validated();
        $course->update($attr);
        session()->flash('message', 'Succeflly updated the course details');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}