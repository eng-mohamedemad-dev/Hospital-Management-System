<?php

namespace App\Http\Requests\Doctor;

use App\Http\Requests\BaseRequest;

class DoctorLoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:doctors,email',
            'password' => 'required|string|min:8',
            'remember_me' => 'boolean',
        ];
    }
}
