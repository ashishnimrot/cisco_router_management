<?php

namespace App\Http\Responses;

use App\Traits\ApiResponser;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Str;

abstract class BaseResponse implements Responsable
{
    use ApiResponser;

    protected $accepts = [
        'json'
    ];

    protected $response;

    public function __construct($response)
    {
        $this->response = $response;
    }


    public function toResponse($request)
    {
        foreach ($this->accepts as $accept) {
            $requestMethod = 'wants'.Str::studly($accept);
            $responseMethod = 'to'.Str::studly($accept);

            if ($request->{$requestMethod}()) {
                return $this->{$responseMethod}();
            }
        }

        return $this->toHtml();
    }
}
