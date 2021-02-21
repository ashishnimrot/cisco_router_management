<?php

namespace App\Http\Responses\Router;

use App\Http\Responses\BaseResponse;

class RouterStoreResponse extends BaseResponse
{
    public function toJson()
    {
        return $this->show(['router' => $this->response], 201, 'Router create successfully!');
    }

    public function toHtml()
    {
        return view('router.index', [
            'routers' => $this->response,
        ]);
    }
}
