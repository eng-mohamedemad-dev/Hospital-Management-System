<?php

namespace App\Http\Requests\Doctor;

use App\Http\Requests\BaseRequest;

class DoctorRegisterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email',
            'password' => 'required|string|min:8',
            'specialist_id' => 'required|integer|exists:specialists,id',
            'hospital' => 'required|string|max:255',
            'about' => 'required|string|max:255',
            'str' => 'required|string|max:255',
        ];
    }
}
