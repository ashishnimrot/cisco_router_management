<?php


namespace App\Contracts;


use App\Http\Requests\Router\RangeRequest;
use Illuminate\Contracts\Support\Responsable;

interface RouterRepositoryContract
{
    public function getListByRange(RangeRequest $request);
}
