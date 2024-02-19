<?php

namespace App\Repositories;

use App\Interfaces\IBaseRepository;
use App\Traits\RepositoryHelper;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Constants\PaginatorPerPage;
use Illuminate\Database\Eloquent\{Builder, Collection, Model};
use App\Models\BaseModel;

abstract class BaseRepository implements IBaseRepository
{
    use RepositoryHelper;

    /**
     * @param array $data
     * @param array|string|null $with
     * @return LengthAwarePaginator
     */
    public function paginatedList(array $data, array|string $with = null): LengthAwarePaginator
    {
        $query = $this->query();

        if (method_exists($this->getBaseModel(), 'scopeFilter'))
        {
            $query->filter($data);
        }

        if (!is_null($with))
        {
            $query->with($with);
        }

        return $query->paginate(PaginatorPerPage::PER_PAGE);
    }

    /**
     * @param array $data
     * @return Model|array|Collection|Builder|BaseModel|null
     */
    public function create(array $data): Model|array|Collection|Builder|BaseModel|null
    {
        $model = $this->getBaseModel();
        $model->fill($data);
        $model->save();
        return $model;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Model|array|Collection|Builder|BaseModel|null
     */
    public function update(array $data, int $id): Model|array|Collection|Builder|BaseModel|null
    {
        $model = $this->findById($id);
        $model->fill($data);
        $model->save();
        return $model;
    }

    /**
     * @param int $id
     * @return array|Builder|Collection|BaseModel
     */
    public function delete(int $id): array|Builder|Collection|BaseModel
    {
        $model = $this->findById($id);
        $model->delete();
        return $model;
    }

    /**
     * @param int $id
     * @return Model|array|Collection|Builder|BaseModel|null
     */
    public function findById(int $id): Model|array|Collection|Builder|BaseModel|null
    {
        return $this->getBaseModel()::query()->findOrFail($id);
    }
}



