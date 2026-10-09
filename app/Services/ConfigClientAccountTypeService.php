<?php

namespace App\Services;

use App\Repositories\ConfigClientAccountTypeRepository;
use App\Services\AccountTypeService;
use App\Mapper\ConfigClientAccountTypeMapper;
class ConfigClientAccountTypeService
{
    public function __construct(
        protected ConfigClientAccountTypeRepository $configClientAccountTypeRepository,
        protected AccountTypeService $accountTypeService,
        protected ConfigClientAccountTypeMapper $configClientAccountTypeMapper
    )
    {
    }

    public function create(): void
    {
        $accountTypes = $this->accountTypeService->get();

        foreach ($accountTypes as $accountType) {
            $dto = $this->configClientAccountTypeMapper->map($accountType->toArray());

            $this->configClientAccountTypeRepository->create($dto->toArray());
        }
    }

    public function getByName(array $names)
    {
        return $this->configClientAccountTypeRepository->getByName($names);
    }
}