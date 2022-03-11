<?php

namespace App\Services\ResultsServices;

use App\Models\Course;
use App\Models\CourseRegistration;

class ContinuousViewService
{

    public static function generateResults($studentsWithReg, $course, $withScores, $prog)
    {
        $distinctCourses = $course->groupBy('SEMESTER');
        $table = '<table style="overflow:auto;" class="table table-scrollable table-responsive-sm table-striped table-dark table-bordered">
        <thead>
        <tr>
            <td>
                <img  width = "50px" src=' . asset('./images/logo.jpg') . ' alt="logo" >
            </td>
            <th  class="text-center" colspan="' . ($course->count() + 8) . '"><span class="text-center h3">
            KADUNA POLYTECHNIC <br></span>
            <span class="h6">College of  ' . $prog->department->college->COLLEGE . '<br>
            School of ' . $prog->school->SCHOOL . ' <br>
            Department of ' . $prog->department->DEPARTMENT . '
            </span>
            <br>
            </th>
        </tr>
        <tr>
            <th colspan="2"> Student Details</th>';
        foreach ($distinctCourses as $c) {
            $table .= '<th class="text-center"colspan="' . $c->count() . '">Semester Performance</th>
            <th colspan="3">GPA</th>';
        }
        $table .= "</tr>

        <tr>
         <th>Regno</th>
        <th>Name</th>";
        foreach ($distinctCourses as $course) {
            $course = $course->sortBy('COURSE_CODE');
            foreach ($course as $c) {
                $table .= ' <th style="text-align:center;">' . $c->COURSE_CODE . '<br>(' . $c->CREDIT_UNITS . ')</th>';
            }
            $table .= "  <th>CP</th>
        <th>CU</th>
        <th>GP</th>";
        }
        $table . "</thead>
         <tbody>";
        $table .= self::generateRowsForContinuousResults($distinctCourses, $studentsWithReg, $withScores);
        $table .= "</tbody></table>";
        return $table;
    }
    public static function generateRowsForContinuousResults($distinctCourses, $students, $withScores)
    {
        $currentCourse = new CourseRegistration();
        $table = "";
        foreach ($students as $s) {
            //($s, $s->registration);
            $cu = 0;
            $cp = 0;
            $table .= "<tr><td>$s->REG_NUMBER</td><td>$s->fullname</td>";
            foreach ($distinctCourses as $semesterCourses) {
                $semesterCourses = $semesterCourses->sortBy('COURSE_CODE');
                //$coursesForSem = $cc->where('semester', $semNo);
                //$coursesForSem = $coursesForSem->sortBy('code');
                //$regForSem = $studentsReg->where('semester', $semNo);
                foreach ($semesterCourses as $semesterCourse) {

                    $bool = false;
                    // dd($s->registration,  $semesterCourse->COURSE_CODE);

                    foreach ($s->registration as $registeredCourse) {
                        if ($registeredCourse->COURSE_ID == $semesterCourse->COURSE_ID) {

                            $bool = true;
                            $currentCourse = $registeredCourse;
                            $cu += $semesterCourse->CREDIT_UNITS;
                            break;
                        }
                    }

                    if ($bool) {
                        $table .= "<td>" . $currentCourse->grade;
                        $cp += $currentCourse->gradePoints;
                        if ($withScores) {
                            $table .= "<br>$currentCourse->total";
                        }
                        $table .= "</td>";
                    } else {
                        $table .= "<td>NR</td>";
                    }
                }
                $gp = $cu == 0 ? 0 : $cp / $cu;
                $gp = round($gp, 2, PHP_ROUND_HALF_UP);
                $gp = (strlen($gp) == 1) ? ($gp . ".00") : $gp;
                $table .= "<td>$cp</td><td >$cu</td><td>" . $gp . "</td>";
            }
            $table .= "</tr>";
        }
        return $table;
    }
}