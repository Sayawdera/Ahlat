<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\{Builder, Model};
use App\Models\BaseModel;
trait RepositoryHelper
{
    protected Model $modelClass;
    public function __construct(Model $modelClass)
    {
        $this->modelClass = $modelClass;
    }
    protected function query(): Builder|BaseModel
    {
        $query = $this->getBaseModel()->query();
        return $query->orderByDesc('id');
    }

    protected function getBaseModel(): Model
    {
        return $this->modelClass;
    }
}
