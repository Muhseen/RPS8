<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentListRequest extends FormRequest
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
            'programme_type' => 'required',
            'prog_id' => 'required',
            'dept_id' => 'required',
            'semester' => 'required',
            'session' => 'required',
            'course_id' => 'required',
            'listType' => 'required'           //
        ];
    }
    public function messages()
    {
        return [
            'programme_type.required' => 'Please specify Proramme Type',
            'prog_id.required' => 'Programme Must be Specified',
            'dept_id.required' => 'Depertment not selected',
            'semester.required' => 'Sepcify Semester',
            'session.required' => 'Specify Session',
            'course_id.required' => 'Course Not Specified',

        ];
    }
}