<?php

namespace App\Services\CoursesServices;

use App\Models\Course;

class CoursesServices
{
    public static function getCoursesByProgID($progID)
    {
        return Course::where('PROG_ID', $progID)->orderBy('COURSE_CODE')->get();
    }
    public static function getCourseByCodeLike($code)
    {
        $courses = Course::where('DEPT_ID', auth()->user()->staff->dept_id)
            ->where(function ($query) use ($code) {
                $query->where('COURSE_CODE', 'like', '%' . $code . '%');
                return  $query->orWhere('COURSE_NAME', 'like', '%' . $code . '%');
            })->with('programme')->get();
        $table = '<table class="table table-striped"> <tr><th>Course code</th><th>Course Title</th><th>Programme Type</th> <th>Set Scores</th></tr>';
        foreach ($courses as $c) {
            $table .= "<tr><td> $c->COURSE_CODE</td>";
            $table .= "<td>$c->COURSE_NAME</td>";
            $table .= "<td>{$c->programme->PROG_TYPE}</td>";
            $table .= "<td><a href='/scoresBreakDown/$c->COURSE_ID' class='btn btn-primary'>Set Scores Breakdown</a></td></tr>";
        }
        $table .= "</table>";
        return $table;
    }
}