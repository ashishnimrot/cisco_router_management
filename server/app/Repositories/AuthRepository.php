<?php


namespace App\Repositories;


use App\Contracts\AuthRepositoryContract;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthRepository implements AuthRepositoryContract
{
    /**
     * @inheritDoc
     */
    public function login(FormRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        try {
            $token = auth()->attempt($credentials);

            if(!$token) {
                throw new AuthenticationException();
            }
        } catch (JWTException $e) {
            throw new JWTException(500);
        }

        return $this->createNewToken($token);
    }

    /**
     * @inheritDoc
     */
    public function register(FormRequest $request)
    {
        return User::create(
            array_merge($request->only(['email', 'name']),
            ['password' => bcrypt($request->password)]
        ));
    }

    /**
     * @inheritDoc
     */
    public function logout()
    {
        return auth()->logout();
    }

    /**
     * @inheritDoc
     */
    public function profile()
    {
        return auth()->user();
    }

    /**
     * @inheritDoc
     */
    public function createNewToken($token)
    {
        return [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ];
    }

    /**
     * @param array $request
     * @param Model $model
     * @return Model|\Illuminate\Http\JsonResponse
     */
    public function update(array $request, Model $model)
    {
        $model->update($request);
        return $model->refresh();
    }
}
