<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
            'name_ar' => 'sometimes |required',
            'name_en' => 'sometimes |required',
            'email'=>'sometimes |required',
            'password'=>'sometimes |required',
            'specialization_id'=>'sometimes |required',
            'gender_id'=>'sometimes |required',
            'joining_Date'=>'sometimes |required',
            'address'=>'sometimes |required'
        ];
    }
}
