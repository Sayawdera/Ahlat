<?php

namespace App\Repositories;

use App\Models\CrudGenerator;

class CrudGeneratorRepository extends BaseRepository
{
    public function __construct(CrudGenerator $model)
    {
        $this->model = $model;
    }
}
