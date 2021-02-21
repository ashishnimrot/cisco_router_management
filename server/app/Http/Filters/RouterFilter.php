<?php

namespace App\Http\Filters;



use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RouterFilter extends QueryFilter
{
    /**
     * @param string $status
     */
    public function sapId(string $search)
    {
        $this->builder->orWhere('sap_id', 'LIKE', '%'.strtolower($search).'%');
    }

    /**
     * @param string $title
     */
    public function hostname(string $search)
    {
        $this->builder->orWhere('hostname', 'LIKE', '%'.strtolower($search).'%');
    }

    /**
     * @param string $status
     */
    public function loopback(string $search)
    {
        $this->builder->orWhere('loopback', 'LIKE', '%'.strtolower($search).'%');
    }

    /**
     * @param string $status
     */
    public function macAddress(string $search)
    {
        $this->builder->orWhere('mac_address', 'LIKE', '%'.strtolower($search).'%');
    }

    /**
     * @return array
     */
    protected function fields(): array
    {
        return array_filter(
            array_map('trim', $this->request->input('fields') ?? [])
        );
    }

    /**
     * @param Builder $builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->fields() as $field => $value) {
            $method = Str::camel($value);
            if (method_exists($this, $method)) {
                call_user_func_array([$this,$method], [$this->request->input('filter') ?? '']);
            }
        }

        $this->sort();
    }

}
