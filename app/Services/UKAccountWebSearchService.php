<?php

namespace App\Services;

use App\Jobs\MapUKAccountWebSearchBrokerChunkJob;
use App\Repositories\UKAccountWebSearchRepository;

class UKAccountWebSearchService extends BaseUKService
{

    public function __construct(
        protected UKAccountWebSearchRepository $uKAccountWebSearchRepository
    ){
        parent::__construct(
            $uKAccountWebSearchRepository,
            MapUKAccountWebSearchBrokerChunkJob::class,
            'AccountID',
            5000,
            'account-manager'
        );
    }

    public function getDemographicsToMap()
    {
        return $this->uKAccountWebSearchRepository->getDemographicsToMap();
    }

    public function getSourcesToMap()
    {
        return $this->uKAccountWebSearchRepository->getSourcesToMap();
    }
}