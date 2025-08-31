<?php

namespace App\Http\Requests\Doctor;

use App\Http\Requests\BaseRequest;

class DoctorVerifyRequest extends BaseRequest
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
            'code' => 'required|string|max:6|exists:verification_codes,code',
        ];
    }
}
