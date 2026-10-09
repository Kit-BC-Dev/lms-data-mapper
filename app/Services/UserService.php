<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    public function __construct(private UserRepository $userRepository){}

    public function create(array $data)
    {
        $this->userRepository->create($data);
    }

    public function getUserByExternalReference(array $externalReferences)
    {
        return $this->userRepository->getUserByExternalReference($externalReferences);
    }
}