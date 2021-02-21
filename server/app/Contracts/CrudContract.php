<?php


namespace App\Contracts;
use Illuminate\Database\Eloquent\Model;

Interface CrudContract
{
    /**
     * @return mixed
     */
    public function all();

    /**
     * Create new model
     *
     * @param Model $model
     * @return mixed
     */
    public function store(array $request);

    /**
     * Update model
     *
     * @param Model $model
     * @return mixed
     */
    public function update(array $request, Model $model);

    /**
     * @param Model $model
     * @return mixed
     */
    public function find(Model $model);

    /**
     * @param Model $model
     * @return mixed
     */
    public function destroy(Model $model);

    /**
     * @param Model $model
     * @return mixed
     */
    public function restore(Model $model);

}
