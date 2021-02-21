<?php


namespace App\Contracts;


use App\Http\Filters\RouterFilter;
use Illuminate\Http\Request;

interface FilterContract
{
    public function apply(Request $request, RouterFilter $filter);
}
