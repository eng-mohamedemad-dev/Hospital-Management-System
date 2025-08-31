<?php

namespace App\Http\Requests\Patient;

use App\Http\Requests\BaseRequest;

class PatientResendRequest extends BaseRequest
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
        ];
    }
}
