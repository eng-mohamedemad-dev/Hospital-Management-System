<?php

namespace App\Http\Requests\Doctor;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class AppointmentRequest extends BaseRequest
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
            'appointments' => 'required|array',
                'appointments.*.time_from' => 'required|date_format:H:i',
                'appointments.*.time_to' => 'required|date_format:H:i|after:time_from',
                'appointments.*.id' => 'sometimes|integer|exists:appointments,id',
            ];
        }
        return [
            'appointments' => 'required|array',
            'appointments.*.day' => 'required|string|in:Saturday,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday|'.Rule::unique('appointments', 'day')->ignore(auth('doctor')->id()),
            'appointments.*.time_from' => 'required|date_format:H:i',
            'appointments.*.time_to' => 'required|date_format:H:i|after:time_from',
        ];
    }
}
