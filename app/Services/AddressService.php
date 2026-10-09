<?php

namespace App\Services;

use App\Repositories\AddressRepository;
use App\DTO\AddressDTO;
class AddressService
{
    public function __construct(protected AddressRepository $addressRepository){}

    public function getByIDs(array $addressIDs)
    {
        return $this->addressRepository->getByIDs($addressIDs);
    }

    public function create(array $data)
    {
        $this->addressRepository->updateOrCreate($data);
    }
}