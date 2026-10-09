<?php

namespace App\Repositories;

use App\DTO\AddressDTO;
use App\Models\Addresses\Address;

class AddressRepository
{
    public function __construct(protected Address $addressModel){}

    public function getByIDs(array $addressID)
    {
        return $this->addressModel->select('AddressID', 'ExternalReference')->whereIn('ExternalReference', $addressID)
        ->get();
    }


    public function updateOrCreate(array $data)
    {
        $this->addressModel->upsert(
            $data,
            ['ExternalReference']
        );
    }

}