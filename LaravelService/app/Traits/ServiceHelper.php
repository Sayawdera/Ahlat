<?php

namespace App\Traits;

use App\Repositories\BaseRepository;
use Throwable;
trait ServiceHelper
{
    /**
     * @throws Throwable
     */
    protected function getBaseRepository(): BaseRepository
    {
        throw_if(! $this->repository, get_class($this) . ' repository property not implemented');
        return $this->repository;
    }
}
