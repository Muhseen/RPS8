<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassAllocationRequest extends FormRequest
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
            'file_no' => 'required|exists:staff,file_no',
            'programme_type' => 'required',
            'course_id' => 'required',
            'session' => 'required',
            'level' => 'required',
            'semester' => 'required',
            'prog_id' => 'required',
            'staff_name' => 'required',
            'isLeadLec',

        ];
    }
}