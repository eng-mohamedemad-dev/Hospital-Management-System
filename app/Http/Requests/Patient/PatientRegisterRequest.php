<?php

namespace App\Http\Requests\Patient;

use App\Http\Requests\BaseRequest;

class PatientRegisterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:patients,email',
            'phone' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ];
    }
}
