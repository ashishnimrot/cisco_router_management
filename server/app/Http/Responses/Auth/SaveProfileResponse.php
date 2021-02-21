<?php

namespace App\Http\Responses\Auth;

use App\Http\Responses\BaseResponse;

class SaveProfileResponse extends BaseResponse
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
