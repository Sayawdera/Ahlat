<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest\StoreCrudGeneratorRequest;
use App\Http\Requests\UpdateRequest\UpdateCrudGeneratorRequest;
use App\Http\Resources\CrudGeneratorResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\CrudGenerator;
use App\Services\CrudGeneratorService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CrudGeneratorController extends Controller
{
    /**
     * @var CrudGeneratorService
     */
    private CrudGeneratorService $service;

    /**
     * @param $service
     */
    public function __construct($service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return CrudGeneratorResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StoreCrudGeneratorRequest $request
     * @return array|Builder|Collection|CrudGenerator
     * @throws Throwable
     */
    public function store(StoreCrudGeneratorRequest $request): array|Builder|Collection|CrudGenerator
    {
        return $this->service->createModel( $request->validated() );
    }

    /**
     * @param int $crudgeneratorId
     * @return CrudGeneratorResource
     * @throws Throwable
     */
    public function show(int $crudgeneratorId): CrudGeneratorResource
    {
        return new CrudGeneratorResource( $this->service->getModelById( $crudgeneratorId ) );
    }

    /**
     * @param UpdateCrudGeneratorRequest $request
     * @param int $crudgeneratorId
     * @return array|CrudGenerator|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateCrudGeneratorRequest $request, int $crudgeneratorId): array|CrudGenerator|Collection|Builder
    {
        return $this->service->updateModel( $request->validated(), $crudgeneratorId );
    }

    /**
     * @param int $crudgeneratorId
     * @return array|Builder|Collection|CrudGenerator
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array|Builder|Collection|CrudGenerator
    {
        return $this->service->deleteModel( $crudgeneratorId );
    }
}
