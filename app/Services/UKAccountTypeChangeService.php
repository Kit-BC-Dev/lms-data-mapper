<?php

namespace App\Services;

use App\Jobs\MapUKAccountTypeChangeChunkJob;
use App\Repositories\UKAccountTypeChangeRepository;

class UKAccountTypeChangeService extends BaseUKService
{
    public function __construct(UKAccountTypeChangeRepository $uKAccountTypeChangeRepository)
    {
        parent::__construct(
            $uKAccountTypeChangeRepository,
            MapUKAccountTypeChangeChunkJob::class,
            'AccountTypeChangeID',
            2500,
            'account-type-change'
        );
    }
}