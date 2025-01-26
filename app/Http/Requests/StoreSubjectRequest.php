<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'Name_ar' => 'required',
            'Name_en' => 'required',
            'Grade_id' => 'required|integer',
            'Class_id' => 'required|integer',
            'teacher_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'Name_ar.required' => trans('validation.required'),
            'Name_en.required' => trans('validation.required'),
            'Grade_id.required' => trans('validation.required'),
            'Class_id.required' => trans('validation.required'),
            'teacher_id.required' => trans('validation.required'),
        ];
    }
}
