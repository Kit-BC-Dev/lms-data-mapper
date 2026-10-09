<?php

namespace App\Services;

use App\Jobs\MapUKAccountStageChunkJob;
use App\Repositories\UKAccountStageRepository;

class UKAccountStgageService extends BaseUKService
{
    public function __construct(UKAccountStageRepository $uKAccountStageRepository)
    {
        parent::__construct(
            $uKAccountStageRepository,
            MapUKAccountStageChunkJob::class,
            'AccountStageID',
            5000,
            'account-stage'
        );
    }
}