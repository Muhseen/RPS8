<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateCourse extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'COURSE_NAME' => 'required',
            'CREDIT_UNITS' => 'required',
            'COURSE_CODE' => 'required',
            'PROG_ID' => 'required',
            'LEVEL' => 'required',
            'SEMESTER' => 'required'
        ];
    }
}