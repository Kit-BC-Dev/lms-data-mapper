<?php

namespace App\Repositories;

use App\Models\Accounts\AccountStage;

class UKAccountStageRepository extends BaseUKRepository
{
    public function __construct(AccountStage $accountStage)
    {
        parent::__construct(
            $accountStage,
            'AccountStageID'
        );
    }
}