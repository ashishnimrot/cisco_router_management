<?php

namespace App\Http\Responses\Auth;

use App\Http\Responses\BaseResponse;

class AuthRegisterResponse extends BaseResponse
{
    public function toJson()
    {
        return $this->show($this->response, 201, 'User register successfully!');
    }

    public function toHtml()
    {
        return view('register', [
            'user' => $this->response
        ]);
    }
}
