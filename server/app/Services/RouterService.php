<?php

namespace App\Services;

use App\Http\Filters\QueryFilter;
use App\Http\Filters\RouterFilter;
use App\Http\Requests\Router\RangeRequest;
use App\Http\Requests\Router\StoreRequest;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

interface RouterService
{
    /**
     * @param RangeRequest $request
     * @return Responsable
     */
    public function getListByRange(RangeRequest $request);

    /**
     * @param Request $request
     * @return Responsable
     */
    public function apply(Request $request, RouterFilter $filter);

    /**
     * @param array $request
     * @return Responsable
     */
    public function store(StoreRequest $request);

    /**
     * @param Request $request
     * @param Model $model
     * @return Responsable
     */
    public function update(Request $request, Model $model);

    /**
     * @param Model $model
     * @return Responsable
     */
    public function find(Model $model);

    /**
     * @param Model $model
     * @return Responsable
     */
    public function destroy(Model $model);

    /**
     * @return mixed
     */
    public function all();
}
