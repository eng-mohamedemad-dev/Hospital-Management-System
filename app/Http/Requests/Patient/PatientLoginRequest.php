<?php

namespace App\Http\Requests\Patient;

use App\Http\Requests\BaseRequest;

class PatientLoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:patients,email',
            'password' => 'required|string|min:8',
            'remember_me' => 'boolean',
        ];
    }
}
