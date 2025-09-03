<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Doctor\AddressRequest;
use App\Interfaces\Doctor\AddressInterface;
use App\Http\Resources\AddressResource;

class AddessController extends Controller
{
    public function __construct(private AddressInterface $addressService)
    {
        $this->middleware('auth:doctor');
    }
    public function index()
    {
        $address = $this->addressService->getAddress();
        if (!$address) {
            return $this->error('No address found for this doctor', null, 404);
        }
        return $this->success('Address retrieved successfully', new AddressResource($address));
    }

    public function store(AddressRequest $request)
    {
        $address = $this->addressService->createAddress($request->validated());
        if(!$address){
            return $this->error('exactly one address is allowed');
        }
        return $this->success('Address created successfully', new AddressResource($address));
    }

    public function update(AddressRequest $request)
    {
       $address = $this->addressService->updateAddress($request->validated());
       if (!$address) {
           return $this->error('Failed to update address', null, 400);
       }
       $updatedAddress = $this->addressService->getAddress();
       return $this->success('Address updated successfully', new AddressResource($updatedAddress));
    }

    public function destroy()
    {
        $address = $this->addressService->deleteAddress();
        return $this->success('Address deleted successfully');
    }
}
