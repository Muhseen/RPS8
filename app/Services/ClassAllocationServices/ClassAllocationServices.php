<?php

namespace App\Services\ClassAllocationServices;

use App\Models\ClassAllocation;
use App\Models\Department;
use App\Models\Programme;
use App\Models\Course;

class ClassAllocationServices
{
    public static function getDept($programme_type)
    {
        if (auth()->user()->menuroles == "EO") {
            $dept = Department::whereDeptId(auth()->user()->staff->dept_id)->first();
            return [["dept_rel" => $dept]];
        }
        return ClassAllocation::where('file_no', auth()->user()->file_no)
            ->where('programme_type', $programme_type)
            ->with('deptRel:DEPT_ID,DEPARTMENT')->get();
    }
    public static function getProgramme($programme_type, $dept_id)
    {

        if (auth()->user()->menuroles == "EO") {
            $progs = Programme::whereDeptId(auth()->user()->staff->dept_id)
                ->whereProgType($programme_type)->select(['PROG_ID', 'PROGRAMME'])->get();
            $result = [];
            foreach ($progs as $prog) {
                $result[] = ['prog_rel' => $prog];
            }
            return $result;
        }
        //Remove code above when each lecturer is Responsible for their course
        return ClassAllocation::where('file_no', auth()->user()->file_no)
            ->where('programme_type', $programme_type)
            ->where('dept_id', $dept_id)
            ->with('progRel:PROG_ID,PROGRAMME')->get();
    }
    public static function getSession($programme_type, $dept_id, $prog_id)
    {
        return [['session' => '2021/2022']];
        return ClassAllocation::where('file_no', auth()->user()->file_no)
            ->where('programme_type', $programme_type)
            ->where('dept_id', $dept_id)
            ->where('prog_id', $prog_id)
            ->get();
    }
    public static function getSemester($programme_type, $dept_id, $prog_id, $session)
    {
        if (auth()->user()->menuroles == "EO") {
            return [["semester" => 1]];
        }
        return ClassAllocation::where('file_no', auth()->user()->file_no)
            ->where('programme_type', $programme_type)
            ->where('dept_id', $dept_id)
            ->where('prog_id', $prog_id)
            ->where('session', $session)
            ->get();
    }
    public static function getCourses($programme_type, $dept_id, $prog_id, $session, $semester)
    {
        return 1;
        return [$prog_id, $dept_id];
        if (auth()->user()->menuroles == "EO") {
            $courses = Course::whereProdId($prog_id)->whereDeptId($dept_id)->get();
            $result = [];
            foreach ($courses as $course) {
                $result[] = ['course_rel' => $course];
            }
        }
        return ClassAllocation::where('file_no', auth()->user()->file_no)
            ->where('programme_type', $programme_type)
            ->where('dept_id', $dept_id)
            ->where('prog_id', $prog_id)
            ->where('session', $session)
            ->with('courseRel:COURSE_ID,COURSE_CODE,COURSE_NAME')
            ->get();
    }
}