<?php

namespace App\Traits;

trait ArrayableDTO
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}