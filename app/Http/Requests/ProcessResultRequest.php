<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessResultRequest extends FormRequest
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
            'prog_id' => 'required',
            'session' => 'required',
            'semester' => 'required'
        ];
    }
    public function messages(): array
    {
        return
            [
                'prog_id.required' => 'Please select the Programme',
                'session' => 'Please specify the session',
                'semester' => 'Please specify the semester',
                'level' => "Please specify the class",
                'type' => 'Please specify the resulr type Continuous or Semester',
                'programme_type' => 'Please specify the Programme Type ',

            ];
    }
}