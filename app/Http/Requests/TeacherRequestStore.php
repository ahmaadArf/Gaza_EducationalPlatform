<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequestStore extends FormRequest
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
              'name_ar' => 'required',
            'name_en' => 'required',
            'email'=>'required',
            'password'=>'required',
            'specialization_id'=>'required',
            'gender_id'=>'required',
            'joining_Date'=>'required',
            'address'=>'required',
        ];
    }
}
