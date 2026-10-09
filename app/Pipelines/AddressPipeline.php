<?php

namespace App\Pipelines;

use App\Mapper\AddressMapper;
use App\Services\AddressService;
use Closure;

class AddressPipeline
{
    public function __construct(protected AddressService $addressService, protected AddressMapper $addressMapper){}

    public function handle($data, Closure $next)
    {
        if (!empty($data->address)) {
            $address = $this->addressService->create($this->addressMapper->map($data->address->toArray()));
            $data->address = $address;
        }

        return $next($data);
    }
    
}