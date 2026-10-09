<?php

namespace App\Services;

use App\Mapper\ConfigAccountStatusMapper;
use App\Repositories\ConfigAccountStatusRepository;

class ConfigAccountStatusService
{
    public function __construct(
        protected ConfigAccountStatusRepository $configAccountStatusRepository,
        protected AccountStatusService $accountStatusService,
        protected ConfigAccountStatusMapper $configAccountStatusMapper
    ){}

    public function create()
    {
        $accountStatuses = $this->accountStatusService->get();

        foreach ($accountStatuses as $accountStatus) {
            $dto = $this->configAccountStatusMapper->map($accountStatus->toArray());

            $this->configAccountStatusRepository->create($dto->toArray());
        }
    }

    public function getByDisplayName(array $displayNames)
    {
        return $this->configAccountStatusRepository->getByDisplayName($displayNames);
    }
}