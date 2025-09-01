<?php

namespace App\Http\Requests\Patient;

use App\Http\Requests\BaseRequest;

class ReviewRequest extends BaseRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if(request()->method() === 'PUT'){
            return [
                'rating' => 'sometimes|integer|min:1|max:5',
                'comment' => 'sometimes|string|max:255',
                'doctor_id' => 'required|integer|exists:doctors,id',
            ];
        }
        return [
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
            'doctor_id' => 'required|integer|exists:doctors,id',
        ];

    }
}
