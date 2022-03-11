<?php

namespace App\Http\Controllers;

use App\Models\GraduatedStudents;
use Illuminate\Http\Request;

class StatementOfResultController extends Controller
{
    public function index(Request $request)

    {
        $student = GraduatedStudents::where('REG_NUMBER', $request->REG_NUMBER)->first();
        $table = "<table class='table text-center' style='border:none'>
        <tbody>
        <tr>
            <td></td>
            <td class='text-right'>REF : $student->REG_NUMBER</td>
        </tr>
        <tr>
            <td></td>
            <td class='text-right'>DATE : $student->ACADEMIC_DATE</td>
        </tr>

        <tr>
            <td colspan='2'>
            THIS IS TO CERTIFY THAT<br>
            <span style='fon-family:certificate'><b>$student->FULLNAME </b> </span><br>
            WITH REGISTRATION NUMBER : <b>$student->REG_NUMBER </b><br>
            having completed an approved programme of study and passed the<br>
            prescribed examinations, has under the authority of <br>
            the Academic board been awarded <b>" . $student->TYPE_OF_DEGREE . "</b><br>
            of Kaduna polytechnic in <b><upper>" . $student->DEPARTMENT . "</b></upper><br>
            at <b>" . $student->CLASS_OF_DEGREE . "</b> level with effect from " . $student->ACADEMIC_DATE . ".<br>
            on behalf of the Rector, I congratulate you on your success.
            
            The Certificate will be issued in due course.

            </td>
        </tr>
        <tr>
        <td>
         <u>HOD NAME</u>
        </td>
        <td>
        <u>
        Dr. MUHAMMAD SANI MUSA
        </u>
        </td>
        </tr>
        <tr>
        <td>
        NAME AND SIGNATURE OF<br>
        HEAD OF DEPARTMENT
        </td>
        <td>
        NAME AND SIGNATURE OF<br>
        REGISTRAR
        </td>
        </tr>
        <tr>
        <td colspan = '2' class='text-center'>Valid for only one year</td>
        </tr>

        </tbody>
        </table>";
        return view('results.statementOfResult')->withTable($table);
    }
}