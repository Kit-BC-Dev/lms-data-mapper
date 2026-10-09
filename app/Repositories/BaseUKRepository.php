<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseUKRepository
{
    public function __construct(
        private Model $model,
        private string $field,
        private array $relationships = [],
        private string $dateField = 'Created'
    )
    {}

    public function chunkIds(
        int $size,
        callable $callback
    ): void {

        $this->model
            ->select($this->field)
            ->orderBy($this->field)
            ->chunkById(
                $size,
                $callback
            );

    }

    public function getChunk(array $ids)
    {
        $query = $this->model
            ->whereIn($this->field, $ids);
        if (!empty($this->relationships)) {
            $query->with($this->relationships);
        }
        return $query->get();
    }

}