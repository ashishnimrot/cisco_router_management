<?php

namespace App\Http\Responses\Auth;

use App\Http\Responses\BaseResponse;

class AuthLoginResponse extends BaseResponse
{
    public function toJson()
    {
        return $this->show($this->response, 200, 'User successfully login');
    }

    public function toHtml()
    {
        return view('login', [
            'user' => $this->response,
        ]);
    }
}
