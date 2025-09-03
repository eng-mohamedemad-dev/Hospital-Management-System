<?php

namespace App\Http\Requests\Doctor;

use App\Http\Requests\BaseRequest;

class AddressRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if (request()->method() === 'PUT') {
        return [
                'country' => 'sometimes|required|string|max:255',
                'state' => 'sometimes|required|string|max:255',
                'address' => 'sometimes|required|string|max:255',
            ];
        }
        return [
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ];
    }
}
