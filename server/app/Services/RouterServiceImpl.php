<?php
namespace App\Services;

use App\Contracts\FilterContract;
use App\Contracts\RouterRepositoryContract;
use App\Http\Filters\RouterFilter;
use App\Http\Requests\Router\RangeRequest;
use App\Http\Requests\Router\StoreRequest;
use App\Http\Responses\Router\RouterDeleteResponse;
use App\Http\Responses\Router\RouterFilterResponse;
use App\Http\Responses\Router\RouterIndexResponse;
use App\Http\Responses\Router\RouterShowResponse;
use App\Http\Responses\Router\RouterStoreResponse;
use App\Http\Responses\Router\RouterUpdateResponse;
use App\Repositories\RouterRepository;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RouterServiceImpl implements RouterService
{
    /**
     * @var RouterRepository
     */
    private RouterRepositoryContract $routerRepository;

    /**
     * @var FilterContract
     */
    private FilterContract $filterContract;

    public function __construct(RouterRepositoryContract $routerRepository)
    {
        $this->routerRepository = $routerRepository;
    }

    /**
     * @param RangeRequest $request
     * @return Responsable
     */
    public function getListByRange(RangeRequest $request)
    {
        return new RouterIndexResponse($this->routerRepository->getListByRange($request));
    }

    /**
     * @param Request $request
     * @return Responsable
     */
    public function apply(Request $request, RouterFilter $filter)
    {
        return new RouterFilterResponse($this->routerRepository->apply($request, $filter));
    }

    /**
     * @param array $request
     * @return Responsable
     */
    public function store(StoreRequest $request)
    {
        return new RouterStoreResponse($this->routerRepository->store($request->all()));
    }

    /**
     * @param Request $request
     * @param Model $model
     * @return Responsable
     */
    public function update(Request $request, Model $model)
    {
        return new RouterUpdateResponse($this->routerRepository->update($request->all(), $model));
    }

    /**
     * @param Model $model
     * @return Responsable
     */
    public function find(Model $model)
    {
        return new RouterShowResponse($this->routerRepository->find($model));
    }

    /**
     * @param Model $model
     * @return Responsable
     */
    public function destroy(Model $model)
    {
        return new RouterDeleteResponse($this->routerRepository->destroy($model));
    }

    /**
     * @inheritDoc
     */
    public function all()
    {
        return new RouterIndexResponse($this->routerRepository->all());
    }
}
