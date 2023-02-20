<?php

namespace App\Services\ResultsServices;

use App\Models\Programme;
use App\Models\Course;
use App\Models\CourseRegistration;
use App\Services\GradesServices\GradesServices;
use Illuminate\Http\Request;

class  SemesterViewService
{

    public static function generateTable($request, $studentsWithReg, $prog_id, $withScores, $sem, $session)
    {
        $semesters = ['First', 'Second'];
        $prog = Programme::where('PROG_ID', $prog_id)->first();
        $courses = Course::where(['PROG_ID' => $prog_id, 'LEVEL' => $studentsWithReg->first()->CURRENT_LEVEL, 'SEMESTER' => $semesters[$sem - 1]])
            ->orderBy('COURSE_CODE')->get();
        //dd($courses, $studentsWithReg->first(), $prog_id, $withScores, $sem, $session);
        $now = time();
        $table = '<table  id="resultTable" style="overflow:auto;font-family: "Lucida Console", "Courier New", monospace; " class="table table-scrollable table-responsive-sm table-striped table-dark table-bordered">
                <thead class="stickyHead">
                <tr>
                <th>
                    <img src="' . asset('./images/logo.jpg') . '" alt="logo" width="100px" >
                </th>
                <th class="text-center" colspan="' . (count($courses) + 10) . '">
                <span class="text-center h3">
                KADUNA POLYTECHNIC <br></span>
                <span class="h6">College of  ' . $prog->department->college->COLLEGE . '<br>
                School of ' . $prog->school->SCHOOL . ' <br>
                Department of ' . $prog->department->DEPARTMENT . ' <br>
                Programme : ' . $prog->PROGRAMME . ' <br>Level : ' . $request->level . ' </span>
                <br>
                </th>
                <th>
                <img src="' . asset('./images/logo.jpg') . '"  class="img-rounded float-right"alt="logo" width="100px" >

                </th>
            </tr>

                <tr >
                        <th colspan="3" class="text-center" class="position-sticky top-0"> Student Details</th>
                        <th class="text-center"colspan="' . count($courses) . '" class="position-sticky top-0">Semester Performance</th>
                        <th colspan="3" >Current Semester</th>
                        <th colspan="3" >Previous Cumulative</th>
                        <th colspan="3" >Current Cumulative</th>

                        </tr>
                    <tr>
                        <th class="position-sticky top-0">S/N</th>
                        <th class="position-sticky top-0">Regno</th>
                        <th class="position-sticky top-0">Name</th>';

        foreach ($courses as $course) {
            $table .= ' <th style="text-align:center;" class="position-sticky top-0">' . $course->COURSE_CODE . '<br>(' . $course->CREDIT_UNITS . ')</th>';
        }
        $table .= "  <th class='position-sticky top-0'>CP</th>
                    <th class='position-sticky top-0'>CU</th>
                    <th class='position-sticky top-0'>GPA</th>
                    <th class='position-sticky top-0'>CP</th>
                    <th class='position-sticky top-0'>CU</th>
                    <th class='position-sticky top-0'>GPA</th>
                    <th class='position-sticky top-0'>CP</th>
                    <th class='position-sticky top-0'>CU</th>
                    <th class='position-sticky top-0'>GPA</th>
                    <th class='position-sticky top-0'>Remarks</th>
                     </tr>
                    </thead>
                     <tbody style='font-size:8px !important;'>";

        //return $table;
        $table .= self::generateRowsForSemester(
            $studentsWithReg,
            $courses,
            $withScores,
            $sem
        );

        $table .= "</tbody></table>";

        return $table;
    }
    public static function generateRowsForSemester($studentsWithReg, $courses, $withScores, $sem)
    {
        $table = "";
        $sn = 0;
        foreach ($studentsWithReg as $student) {
            $nRCourses = [];
            $nRCount = 0;
            $sn++;
            $cu = 0;
            $cp = 0;
            $regg = new CourseRegistration();
            $courseCount = count($courses);
            $table .= "<tr><td>" . $sn . "</td><td style='white-space:nowrap !important ;text-align:left;'>{$student->REG_NUMBER}</td><td style='white-space:nowrap !important ;text-align:left;'>{$student->fullname}</td>";
            for ($i = 0; $i < $courseCount; $i++) {
                $courseFound = false;
                $course = $courses[$i];
                //dd($student->registration, $course);
                foreach ($student->registration as $reg) {
                    if ($reg->COURSE_ID == $course->COURSE_ID) {

                        $courseFound = true;
                        if (in_array($reg->grade, GradesServices::usableGrades())) {
                            $cu += $course->CREDIT_UNITS;
                        }
                        $regg = $reg;
                        break;
                    }
                }
                if ($courseFound) {
                    //dd($regg, $regg->grade, $regg->total);
                    $total = $regg->total; //$course->test1Score + $course->test2Score + $course->practical1Score + $course->practical2Score + $course->assignment1Score + $course->assignment2Score + $course->examScore;
                    $table .= "<td>" . $regg->grade;
                    if ($withScores) {
                        $table .= "<br> " . $total;
                    }
                    $table . '</td>';
                } else {
                    $table .= "<td>NR</td>";
                    $nRCourses[$nRCount] = $course->COURSE_CODE;
                    $nRCount++;
                    // dd($course->COURSE_CODE, $nRCourses, $nRCount);
                }
            }
            $cp =  $student->registration->whereIn('grade', GradesServices::usableGrades())->sum('gradePoints'); //$courses->where('regno', $regno)->sum('gradePoints');
            $failedCourses = $student->registration->whereIn('grade', GradesServices::failedGrades());
            //dd($failedCourses, $student->registration);
            $gp = $cu == 0 ? 0 : $cp / $cu;
            $gp = round($gp, 2, PHP_ROUND_HALF_UP);
            $gp = (strlen($gp) == 1) ? ($gp . ".00") : $gp;
            $remark = "";
            if ($gp <= 1.60) {
                $remark .= "Prob I. Reg < 60% ";
            }
            $table .= "<td>$cp</td><td >$cu</td><td>" . $gp . "</td>";
            if ($sem == 1) {
                $table .= "<td>0</td><td>0</td><td>0</td>";
                $table .= "<td>$cp</td><td >$cu</td><td>" . $gp . "</td></>";
            }
            if ($failedCourses->count() > 0 || count($nRCourses) > 0) {
                if ($failedCourses->count() > 0) {
                    $remark .= "C/Over: ";
                    foreach ($failedCourses as $f) {
                        $code = "";
                        foreach ($courses as $c) //dd($f);
                        {
                            if ($c->COURSE_ID == $f->COURSE_ID) {
                                $code = $c->COURSE_CODE;
                            }
                        }
                        $remark .= " " . $code . ",";
                    }
                }
                if (count($nRCourses) > 0) {
                    if ($failedCourses->count() == 0) {
                        $remark .= "C/Over: ";
                    }
                    for ($k = 0; $k < count($nRCourses); $k++) {
                        $remark .= " " . $nRCourses[$k] . ",";
                    }
                }
            } else {
                $remark .= "PASS";
            }
            $table .= "<td style='white-space:nowrap;text-align:left;'>$remark</td></tr>";
        }

        return $table;
    }
}
