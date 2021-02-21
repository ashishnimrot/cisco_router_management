<?php


namespace App\Repositories;


use App\Contracts\CrudContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Log;

abstract class Repository implements CrudContract
{
    /**
     * @var Model
     */
    private Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @inheritDoc
     */
    public function store(array $request)
    {
        return $this->model->create($request);
    }

    /**
     * @inheritDoc
     */
    public function update(array $request, Model $model)
    {
        return tap($model)->update($request);
    }

    /**
     * @inheritDoc
     */
    public function destroy(Model $model)
    {
        return $model->delete();
    }

    /**
     * @inheritDoc
     */
    public function find(Model $model)
    {
        return $model;
    }

    /**
     * @inheritDoc
     */
    public function restore(Model $model)
    {
        return $model->restore();
    }
}
