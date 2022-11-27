<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScoresUploadRequest extends FormRequest
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
            'scoresFile' => 'required',
            'prog_id' => 'required',
            'session' => 'required',
            'semester' > 'required',
            'level' => 'required',
            'programme_type' => 'required',
            'course_id' => 'required',

        ];
    }

    public function messages()
    {
        return
            [
                'prog_id' => 'Please select the programme',
                'session' => 'Please specify the session',
                'semester' => 'Please specify the semester',
                'level' => "Please specify the class",
                'programme_type' => 'Please specify the Programme Type ',
                'course_id' => 'Please select a course',

            ];
    }
}