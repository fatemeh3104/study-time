<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required','string'],
            'target_type' => ['required','string'],
            'target' => ['required'],
            'start_time' => ['required' ,'time'],
            'end_time' => ['required' , 'time'],
            'Duration' => ['required'],
            'reference_id' => ['required'],
            'chapter_id' => ['required']
        ];
    }
}
