<?php

namespace App\Http\Responses\Router;

use App\Http\Responses\BaseResponse;

class RouterShowResponse extends BaseResponse
{
    public function toJson()
    {
        return $this->show(['router' => $this->response], 200, 'Router info!');
    }

    public function toHtml()
    {
        return view('router.show', [
            'routers' => $this->response,
        ]);
    }
}
