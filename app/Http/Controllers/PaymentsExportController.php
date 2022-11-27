<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Invoice;
use App\Models\Programme;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory as reader;
use Illuminate\Support\Facades\Response;


class PaymentsExportController extends Controller
{
    public function index()
    {
        $ids = Programme::where('prog_type', 'evening')->select('PROG_ID')->get();
        $invoices = Invoice::where('session', '2020/2021')->where('payment_type', 'school fees')->where('status', 'active')->whereIn('prog_id', $ids)->with(['programme', 'programme.department'])->get();
        $depts = Department::orderBy('DEPARTMENT')->get();
        $index = 0;
        $path = storage_path() . "/app/payment.xlsx";
        $sSheet = reader::load($path);
        $sSheet->getActiveSheet()->getProtection()->setSheet(true);
        $sSheet->getDefaultStyle()->getProtection()->setLocked(false);

        foreach ($depts as $dept) {
            $deptInvoices = $invoices->whereIn('PROG_ID', $dept->programmes->pluck('PROG_ID'));
            $sSheet->createSheet();
            // Zero based, so set the second tab as active sheet
            $sSheet->setActiveSheetIndex($index);

            $worksheet = $sSheet->getSheet($index);
            $worksheet->setTitle(substr($dept->DEPARTMENT, 25));
            //$sSheet->getActiveSheet()->setTitle($dept->DEPARTMENT);
            $rowIndex = 1;
            foreach ($deptInvoices as $inv) {
                $worksheet->setCellValue("A" . $rowIndex, $dept->DEPARTMENT);
                $rowIndex += 1;
            }
            $index++;
        }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="hello.xlsx"');
        header('Cache-Control: max-age=0');
        $writer  = new Xlsx($sSheet);
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($sSheet, 'Xlsx');
        $writer->save('php://output');
        //dd($writer);
        try {
            $file = $writer->save("payment file.xlsx");
        } catch (\Exception $ex) {
            dd($ex->getMessage(), $ex);
        } //$file = public_path('new file.xlsx');
        //$filename = "payments"; //str_replace('', '-', $dept->DEPARTMENT) . "-" . str_replace('', '-', $course->COURSE_CODE) . "-" . str_replace('', '-', $progtype) . "-" . str_replace('', '-', $session);
        //$filename = Str::upper(str_replace('/', '_', $filename));
        return Response::download($file, $filename . ".xlsx", []);
    }
}