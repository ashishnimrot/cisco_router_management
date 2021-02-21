<?php

namespace App\Http\Responses\Router;

use App\Http\Responses\BaseResponse;

class RouterIndexResponse extends BaseResponse
{
    public function toJson()
    {
        return $this->show(['routers' => $this->response], 200, 'Router List!');
    }

    public function toHtml()
    {
        return view('router', [
            'routers' => $this->response,
        ]);
    }
}
