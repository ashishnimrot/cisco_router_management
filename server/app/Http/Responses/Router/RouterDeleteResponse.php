<?php

namespace App\Http\Responses\Router;

use App\Http\Responses\BaseResponse;

class RouterDeleteResponse extends BaseResponse
{
    public function toJson()
    {
        return $this->show([], 200, 'Router data updated!');
    }

    public function toHtml()
    {
        return view('router.index', [
            'routers' => $this->response,
        ]);
    }
}
