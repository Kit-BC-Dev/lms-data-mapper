<?php

namespace App\Services;

use App\Jobs\MapUkCardChunkJob;
use App\Repositories\UKCardRepository;
class UKCardService extends BaseUKService
{
    public function __construct(private UKCardRepository $uKCardRepository)
    {
        parent::__construct(
            $uKCardRepository,
            MapUkCardChunkJob::class,
            'CardID',
            1000,
            'cards'
        );
    }
}