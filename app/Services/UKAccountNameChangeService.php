<?php

namespace App\Services;

use App\Jobs\MapUKAccountNameChangeChunkJob;
use App\Repositories\UKAccountNameChangeRepository;

class UKAccountNameChangeService extends BaseUKService
{
    public function __construct(UKAccountNameChangeRepository $uKAccountNameChangeRepository)
    {
        parent::__construct(
            $uKAccountNameChangeRepository,
            MapUKAccountNameChangeChunkJob::class,
            'AccountNameChangeID',
            2500,
            'account-name-change'
        );
    }
}