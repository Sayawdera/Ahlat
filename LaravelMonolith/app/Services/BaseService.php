<?php

namespace App\Services;

use App\Interfaces\IBaseServices;
use App\Repositories\BaseRepository;
use App\Models\BaseModel;
use App\Traits\ServiceHelper;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\{Builder, Collection, Model};
use Throwable;

abstract class BaseService implements IBaseServices
{
    use ServiceHelper;

    /**
     * @var BaseRepository|null
     */
    protected ?BaseRepository $repository = null;

    /**
     * @param array $data
     * @return LengthAwarePaginator
     */
    public function paginatedList(array $data): LengthAwarePaginator
    {
        return $this->repository->paginatedList($data);
    }

    /**
     * @param array $data
     * @return Model|array|Collection|Builder|BaseModel|null
     * @throws Throwable
     */
    public function createModel(array $data): Model|array|Collection|Builder|BaseModel|null
    {
        return $this->getBaseRepository()->create($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return Model|array|Collection|Builder|BaseModel|null
     * @throws Throwable
     */
    public function updateModel(array $data, int $id): Model|array|Collection|Builder|BaseModel|null
    {
        return $this->getBaseRepository()->update($data, $id);
    }

    /**
     * @param int $id
     * @return array|Builder|Collection|Model
     * @throws Throwable
     */
    public function deleteModel(int $id): array|Builder|Collection|Model
    {
        return $this->getBaseRepository()->delete($id);
    }

    /**
     * @param int $id
     * @return Model|array|Collection|Builder|BaseModel|null
     * @throws Throwable
     */
    public function getModelById(int $id): Model|array|Collection|Builder|BaseModel|null
    {
        return $this->getBaseRepository()->findById($id);
    }
}
