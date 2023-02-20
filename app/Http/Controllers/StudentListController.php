<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Programme;
use Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as writer;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory as reader;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\StudentListRequest;
use App\Models\ScoresBreakDown;

class StudentListController extends Controller
{
    public function index(Request $requst)
    {
        return view('studentsList.index');
    }
    public function download(StudentListRequest $request)

    {
        $path = "";
        if (request('listType') == 'normal') {
            $path = storage_path() . "/app/rpsTemplate2.xlsx";
        } else {
            $path = storage_path() . "/app/rpsPracticalTemplate2.xlsx";
        }
        $sSheet = reader::load($path);
        $sSheet->getActiveSheet()->getProtection()->setSheet(true);
        $sSheet->getDefaultStyle()->getProtection()->setLocked(false);
        $worksheet = $sSheet->getSheet(0);
        $progtype = $request->programme_type;
        $semester = $request->semester;
        $session = $request->session;
        $course = Course::where('COURSE_ID', $request->course_id)->first();
        $dept =    Department::where('DEPT_ID', $request->dept_id)->first();
        $prog = Programme::where('PROG_ID', $request->prog_id)->first();
        $semesters = ['First', 'Second'];
        if (request('listType') == 'normal') {
            $regs = CourseRegistration::where([
                'SEMESTER' => $semesters[$semester - 1],
                'SESSION' => $session,
                'COURSE_ID' => $course->COURSE_ID,
                'PROG_ID' => $prog->PROG_ID

            ])->with('student:FIRST_NAME,MIDDLE_NAME,LAST_NAME,REG_NUMBER')->get();

            $scoresBreakDown = ScoresBreakDown::where('course_id', $course->COURSE_ID)->first();
            if ($scoresBreakDown     == null) {
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
            if ($regs->count() == 0) {
                return redirect('/downloadStudentList')->withErrors("No Students For the specified Criteria");
            } else {
                $worksheet->setCellValue("A2", "COLLEGE OF " . Str::upper($dept->college->COLLEGE));
                $worksheet->setCellValue("A3", "DEPARTMENT OF " . Str::upper($dept->DEPARTMENT));
                $worksheet->setCellValue("A4", $course->COURSE_CODE . " (" . $progtype . ") " . $dept->DEPARTMENT . ", " . $session . " SESSION");
                $metric = $scoresBreakDown->examination / 100;
                $minTest = $scoresBreakDown->test1Score + $scoresBreakDown->test2Score + $scoresBreakDown->assignment1Score + $scoresBreakDown->assignment2Score + $scoresBreakDown->practicalScore;
                $index = 7;
                $worksheet->setCellValue("L6", "EXAM * {$metric}");
                $worksheet->setCellValue("J6", "TEST TOTAL({$minTest}%)");


                foreach ($regs as $reg) {
                    //$startIndex = strlen("KPT/" . $reg->student->dept);
                    //$regno = substr($reg->regno,$startIndex+1);
                    if ($reg->REG_NUMBER == null || $reg->student == null) {
                        continue;
                    }
                    try {
                        // dd($reg);
                        $worksheet->setCellValue("A" . $index, $index - 6);
                        $worksheet->setCellValue("B" . $index, $reg->REG_NUMBER);
                        $worksheet->setCellValue("C" . $index, $reg->student->fullname);
                        $worksheet->setCellValue("D" . $index, $reg->test1Score ?? 0);
                        $worksheet->setCellValue("E" . $index, $reg->test2Score ?? 0);
                        $worksheet->setCellValue("F" . $index, $reg->assignment1Score ?? 0);
                        $worksheet->setCellValue("G" . $index, $reg->assignment2Score ?? 0);
                        $worksheet->setCellValue("H" . $index, $reg->practical1Score ?? 0);
                        //$worksheet->setCellValue("I" . $index, 0);
                        $worksheet->setCellValue("J" . $index, "=MIN({$minTest},SUM(D" . $index . ":I" . $index . "))");
                        $worksheet->setCellValue("K" . $index, ($reg->examination * (100 / $scoresBreakDown->examination)));
                        $worksheet->setCellValue("L" . $index, "=MIN({$scoresBreakDown->examination},{$metric}*K" . $index . ")");
                        $worksheet->setCellValue("M" . $index, "=L" . $index . "+J" . $index);
                        $worksheet->setCellValue("N" . $index, "=VLOOKUP(M" . $index . ",Sheet2!\$A$1:\$B$11,2,TRUE)");
                        //=VLOOKUP(M" . $index . ",Sheet2!\$A$1:\$B$11,2,TRUE)

                        $worksheet->getStyle('D' . $index)->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
                        $worksheet->getStyle('E' . $index)->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
                        $worksheet->getStyle('F' . $index)->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);

                        $worksheet->getStyle('g' . $index)->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
                        $worksheet->getStyle('H' . $index)->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
                        $worksheet->getStyle('I' . $index)->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
                        $worksheet->getStyle('K' . $index)->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);

                        $worksheet->getStyle('B' . $index)->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);
                        $worksheet->getStyle('J' . $index)->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);
                        $worksheet->getStyle('L' . $index)->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);
                        //$worksheet->getStyle('J'.$index)->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);
                        $index++;
                    } catch (\Exception $e) {
                        //    dd($e->getMessage(), $reg, $reg->student);
                    }
                }
            }

            $writer = new writer($sSheet);
            $writer->save("new file.xlsx", 1);
            $file = public_path('new file.xlsx');
            $filename = str_replace('', '-', $dept->DEPARTMENT) . "-" . str_replace('', '-', $course->COURSE_CODE) . "-" . str_replace('', '-', $progtype) . "-" . str_replace('', '-', $session);

            $filename = Str::upper(str_replace('/', '_', $filename));
            return Response::download($file, $filename . ".xlsx", []);
        } else {
            $course_id = $request->course_id;
            $cbr = scoresBreakdown::where('course_id', $course_id)->first();
            $prog = Programme::where('PROG_ID', $request->prog_id)->first();
            $course = Course::where('COURSE_ID', $course_id)->first();
            //dd($cbr);
            if ($cbr == null) {
                return back()->withErrors("Practical Score Breakdown has not been set for this course ");
            }

            $regs = CourseRegistration::where([
                'SEMESTER' => $semesters[$semester - 1],
                'SESSION' => $session,
                'COURSE_ID' => $course->COURSE_ID,
                'PROG_ID' => $prog->PROG_ID

            ])->with('student:FIRST_NAME,MIDDLE_NAME,LAST_NAME,REG_NUMBER')->get();
            if ($regs->count() == 0) {
                return back()->withErrors("No Students For the specified Criteria");
            } else {

                //  dd("here");
                $worksheet->setCellValue("A2", "COLLEGE OF " . $dept->college->COLLEGE);
                $worksheet->setCellValue("A3", "DEPARTMENT OF " . $dept->DEPARTMENT);
                $worksheet->setCellValue("A4", $course->COURSE_CODE . " (" . $prog->PROG_TYPE . ") " . $prog->department->DEPARTMENT . ", " . $session . " SESSION");
                $cols = array('D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V');
                $index = 6;
                for ($i = 0; $i < $cbr->practical_count; $i++) {
                    $worksheet->setCellValue($cols[$i] . $index, "PRACTICAL " . ($i + 1));
                }
                $worksheet->setCellValue($cols[$cbr->practical_count] . $index, "TOTAL");
                $worksheet->setCellValue($cols[$cbr->practical_count + 1] . $index, "AVERAGE");
                $index = 7;
                foreach ($regs as $reg) {
                    //$startIndex = strlen("KPT/" . $reg->student->dept);
                    $worksheet->setCellValue("A" . $index, $index - 6);
                    $worksheet->setCellValue("B" . $index, $reg->REG_NUMBER);
                    $worksheet->setCellValue("C" . $index, $reg->student->fullname);
                    for ($i = 0; $i < $cbr->practical_count; $i++) {
                        $worksheet->setCellValue($cols[$i] . $index, 0);
                        $worksheet->getStyle($cols[$i] . $index)->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
                    }
                    $worksheet->setCellValue($cols[$cbr->practical_count] . $index, "=SUM(D" . $index . ":" . $cols[$cbr->practical_count - 1] . $index . ")");
                    $worksheet->setCellValue($cols[$cbr->practical_count + 1] . $index, "=" . $cols[$cbr->practical_count] . $index . "/" . $cbr->practical_count);
                    $index++;
                }
                $writer = new writer($sSheet);
                $writer->save("new file.xlsx");
                $file = public_path('new file.xlsx');
                $filename = "PRACTICALS-" . str_replace('', '-', $dept->DEPARTMENT) . "-" . str_replace('', '-', $course->COURSE_CODE) . "-" . str_replace('', '-', $prog->PROG_TYPE) . "-" . str_replace('', '-', $session);
                $filename = str_replace("/", "_", $filename);
                return Response::download($file, $filename . ".xlsx", []);
            }
        }
    }
}