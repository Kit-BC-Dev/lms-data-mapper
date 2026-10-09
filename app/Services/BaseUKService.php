<?php

namespace App\Services;

class BaseUKService
{
    public function __construct(
        private $repository, 
        private $job,
        private string $field,
        private int $size,
        protected string $onQueue = ''
    )
    {}

    public function doMap(): void
    {
        $total = 0;
        $this->repository->chunkIds($this->size, function ($records) use (&$total) {
            try {
                
                $ids = $records->pluck($this->field)->toArray();
                $total += count($ids);
                $job = $this->job::dispatch($ids, $total);

                $this->onQueue
                    ? $job->onQueue($this->onQueue)
                    : $job;

            } catch (\Throwable $e) {
                logger()->error($e);
                throw $e;
            }
        });
    }
}