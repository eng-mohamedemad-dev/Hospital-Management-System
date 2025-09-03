<?php

namespace App\Services\Doctor;

use App\Interfaces\Doctor\AddressInterface;
use App\Models\Address;

class AddressService implements AddressInterface
{
    private  $doctor = null;
    
    public function __construct()
    {
        $this->doctor = auth('doctor')->user();
    }


    public function createAddress($data)
    {
        $data['doctor_id'] = $this->doctor->id;
        if($this->doctor->address()->exists()){
            return false;
        }
        return Address::create($data);
    }

    public function getAddress()
    {
        if (!$this->doctor) {
            return null;
        }
        return $this->doctor->address()->first();
    }

    public function updateAddress($data)
    {
        if (!$this->doctor) {
            return false;
        }
        return $this->doctor->address()->update($data);
    }

    public function deleteAddress()
    {
        if (!$this->doctor) {
            return false;
        }
        return $this->doctor->address()->delete();
    }
}
