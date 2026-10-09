<?php

namespace App\Services;

use App\Jobs\MapUKAuditedChangesAccountStatusChunkJob;
use App\Repositories\UKAuditedChangesRepository;

class UKAuditedChangesService extends BaseUKService
{
    public function __construct(UKAuditedChangesRepository $uKAuditedChangesRepository)
    {
        parent::__construct(
            $uKAuditedChangesRepository,
            MapUKAuditedChangesAccountStatusChunkJob::class,
            'AuditedChangeID',
            5000,
            'audited-changes'
        );
    }
}