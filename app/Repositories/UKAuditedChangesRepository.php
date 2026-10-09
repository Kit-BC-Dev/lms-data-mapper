<?php

namespace App\Repositories;

use App\Models\Changes\AuditedChanges;

class UKAuditedChangesRepository
{
    public function __construct(private AuditedChanges $model){}

    public function chunkIds(
        int $size,
        callable $callback
    ): void {

        $this->model
            ->select('AuditedChangeID')
            ->where('TableName', 'AccountStatus')
            ->where('FieldModified', 'AccountStatus')
            ->where('Created', '>=', '2026-07-01 00:00:00')
            ->orderBy('AuditedChangeID')
            ->chunkById(
                $size,
                $callback
            );

    }

    public function getChunk(array $ids)
    {
        $query = $this->model->whereIn('AuditedChangeID', $ids);
        return $query->get();
    }
}