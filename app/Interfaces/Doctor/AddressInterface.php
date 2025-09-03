<?php

namespace App\Interfaces\Doctor;

interface AddressInterface
{
    public function createAddress($data);

    public function getAddress();

    public function updateAddress($data);

    public function deleteAddress();
}
