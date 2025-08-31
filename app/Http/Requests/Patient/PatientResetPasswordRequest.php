<?php

namespace App\Http\Requests\Patient;

use App\Http\Requests\BaseRequest;

class PatientResetPasswordRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
