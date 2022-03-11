<?php

namespace App\Services\ClassAllocationServices;

use App\Models\ClassAllocation;

class ClassAllocationServices
{
    public static function getDept($programme_type)
    {
        return ClassAllocation::where('file_no', auth()->user()->file_no)
            ->where('programme_type', $programme_type)
            ->with('deptRel:DEPT_ID,DEPARTMENT')->get();
    }
    public static function getProgramme($programme_type, $dept_id)
    {
        return ClassAllocation::where('file_no', auth()->user()->file_no)
            ->where('programme_type', $programme_type)
            ->where('dept_id', $dept_id)
            ->with('progRel:PROG_ID,PROGRAMME')->get();
    }
    public static function getSession($programme_type, $dept_id, $prog_id)
    {
        return ClassAllocation::where('file_no', auth()->user()->file_no)
            ->where('programme_type', $programme_type)
            ->where('dept_id', $dept_id)
            ->where('prog_id', $prog_id)
            ->get();
    }
    public static function getSemester($programme_type, $dept_id, $prog_id, $session)
    {
        return ClassAllocation::where('file_no', auth()->user()->file_no)
            ->where('programme_type', $programme_type)
            ->where('dept_id', $dept_id)
            ->where('prog_id', $prog_id)
            ->where('session', $session)
            ->get();
    }
    public static function getCourses($programme_type, $dept_id, $prog_id, $session, $semester)
    {
        return ClassAllocation::where('file_no', auth()->user()->file_no)
            ->where('programme_type', $programme_type)
            ->where('dept_id', $dept_id)
            ->where('prog_id', $prog_id)
            ->where('session', $session)
            ->with('courseRel:COURSE_ID,COURSE_CODE,COURSE_NAME')
            ->get();
    }
}