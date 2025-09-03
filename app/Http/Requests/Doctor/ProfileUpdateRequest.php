<?php

namespace App\Http\Requests\Doctor;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class ProfileUpdateRequest extends BaseRequest
{


    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'max:255', Rule::unique('doctors', 'email')->ignore(auth('doctor')->id())],
            'image' => ['sometimes', 'file', 'image', 'max:2048'],
            'about' => ['sometimes', 'string', 'max:2000'],
            'hospital' => ['sometimes', 'string', 'max:255'],
            'experience' => ['sometimes', 'integer', 'min:0', 'max:100'],
            'current_password' => ['sometimes', 'string', 'min:8'],
            'new_password' => ['sometimes', 'string', 'min:8'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function (Validator $validator) {
            $current_password = $this->input('current_password');
            $new_password = $this->input('new_password');
            if ($current_password && !$new_password) {
                $validator->errors()->add('new_password', 'The new_password must be provided.');
            }
        });
    }
}


