<?php

namespace App\Http\Responses\Auth;

use App\Http\Responses\BaseResponse;

class AuthProfileResponse extends BaseResponse
{
    public function toJson()
    {
        return $this->show($this->response, 200);
    }

    public function toHtml()
    {
        return view('profile', [
            'profile' => $this->response,
        ]);
    }
}
