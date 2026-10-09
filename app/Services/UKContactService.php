<?php

namespace App\Services;

use App\Repositories\UKContactRepository;
use App\Jobs\MapUKContactChunkJob;
use App\Jobs\MapUKContactV2ChunckJob;


class UKContactService
{
    public function __construct(protected UKContactRepository $uKContactRepository)
    {}

    public function doMap($table = 'Account History'): void
    {
        $total = 0;
        $this->uKContactRepository->chunkIds(5000, function ($records) use (&$total, $table) {
            try {
                
                $ids = $records->pluck('ContactID')->toArray();
                $total += count($ids);
                switch ($table) {
                    case 'Account History':
                         MapUKContactChunkJob::dispatch($ids, $total);
                         break;
                    case 'Client Notes': 
                         MapUKContactV2ChunckJob::dispatch($ids, $total)->onQueue('client-notes');
                         break;

                    default:
                        throw new InvalidArgumentException("Unknown table: {$table}");

                }
               
    

            } catch (\Throwable $e) {
                logger()->error($e);
                throw $e;
            }
        });
    }
}