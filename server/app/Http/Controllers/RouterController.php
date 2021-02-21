<?php

namespace App\Http\Controllers;

use App\Services\RouterService;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use App\Contracts\{ CrudContract, FilterContract, RouterRepositoryContract };
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Router\{ RangeRequest, StoreRequest, UpdateRequest };
use App\Http\Responses\Router\{ RouterDeleteResponse, RouterFilterResponse, RouterIndexResponse, RouterShowResponse, RouterStoreResponse, RouterUpdateResponse };
use App\Models\Router;
use App\Http\Filters\RouterFilter;

class RouterController extends Controller
{

    /**
     * @var RouterService
     */
    private RouterService $routerService;

    public function __construct(RouterService $routerService)
    {
        $this->routerService = $routerService;
    }

    public function filter (Request $request, RouterFilter $filter)
    {
        return $this->routerService->apply($request, $filter);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->routerService->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        return $this->routerService->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Router $router)
    {
        return $this->routerService->find($router);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Router $router)
    {
        return $this->routerService->update($request, $router);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Router $router)
    {
        return $this->routerService->destroy($router);
    }

    /**
     * @param RangeRequest $request
     * @return RouterIndexResponse
     */
    public function getListByRange(RangeRequest $request)
    {
        return $this->routerService->getListByRange($request);
    }
}
