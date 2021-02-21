<?php

namespace App\Http\Responses\Router;

use App\Http\Responses\BaseResponse;

class RouterFilterResponse extends BaseResponse
{
    public function toJson()
    {
        return $this->show($this->response, 200, 'Router List!');
    }

    public function toHtml()
    {
        return view('router.index', [
            'routers' => $this->response,
        ]);
    }
}
