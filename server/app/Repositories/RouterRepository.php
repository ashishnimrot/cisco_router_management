<?php

namespace App\Repositories;

use App\Contracts\FilterContract;
use App\Contracts\RouterRepositoryContract;
use App\Http\Filters\RouterFilter;
use App\Http\Requests\Router\RangeRequest;
use App\Models\Router;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RouterRepository extends Repository implements FilterContract, RouterRepositoryContract
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function apply(Request $request, RouterFilter $filter)
    {
        return Router::filter($filter)->paginate($request->input('limit'));
    }

    /**
     * @param RangeRequest $request
     * @return array
     */
    public function getListByRange(RangeRequest $request)
    {
        return DB::select(
            DB::raw(
                "with ipaddressTBL as(
                    select *,  INET_ATON(loopback) as ipaddress from `routers`
                ) select * from ipaddressTBL where ipaddress BETWEEN INET_ATON('$request->ipStart')
                AND INET_ATON('$request->ipEnd')"
            )
        );
    }

}
