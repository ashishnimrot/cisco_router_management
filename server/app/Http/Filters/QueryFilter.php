<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class QueryFilter
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Builder $builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->fields() as $field => $value) {
            $method = Str::camel($field);
            if (method_exists($this, $method)) {
                call_user_func_array([$this, $method], (array)$value);
            }
        }

        $this->sort();
    }

    /**
     * @return array
     */
    protected function fields(): array
    {
        return array_filter(
            array_map('trim', $this->request->all())
        );
    }

    /**
     * Sort the collection by the sort field
     * Examples: sort= title,-status || sort=-title || sort=status
     *
     * @param string $value
     */
    protected function sort()
    {
        if(empty($this->request->input('sort'))) {
            return;
        }

        $this->builder->orderBy(Str::snake($this->request->input('sort')), Str::snake($this->request->input('order') ?? 'asc'));
    }
}
