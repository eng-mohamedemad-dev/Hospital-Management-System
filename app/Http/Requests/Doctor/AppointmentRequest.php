<?php

namespace App\Http\Requests\Doctor;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;


class AppointmentRequest extends BaseRequest
{

    public function rules(): array
    {
        $appointmentId = $this->route('appointment') ? $this->route('appointment') : null;
        // dd($appointmentId);
        return
        [
             'day'       =>
             [
                'required',
                'string',
                'max:100',
                Rule::unique('appointments')->ignore($appointmentId) ->where(function ($query)
                {
                    return $query->where('doctor_id', $this->doctor_id);
                }),
            ],
            'time_from' => 'required|string|max:50',
            'time_to'   => 'required|string|max:50',
            'doctor_id' => 'required|exists:doctors,id',
        ];
    }
}
