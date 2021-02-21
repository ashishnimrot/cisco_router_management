<?php

namespace App\Http\Responses\Auth;

use App\Http\Responses\BaseResponse;

class AuthLogoutResponse extends BaseResponse
{
    public function toJson()
    {
        return $this->show($this->response, 200, 'User successfully logout');
    }

    public function toHtml()
    {
        return view('logout');
    }
}
