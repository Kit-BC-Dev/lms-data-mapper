<?php

namespace App\Services;

class ClientOutletAdditionalContactService
{
    public function __construct(
        protected \App\Repositories\ClientOutletAdditionalContactRepository $clientOutletAdditionalContactRepository
    ) {}

    public function create(array $data): void
    {
        $this->clientOutletAdditionalContactRepository->updateAndCreate($data);
    }
}