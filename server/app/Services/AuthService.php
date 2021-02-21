<?php


namespace App\Services;


use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

interface AuthService
{
    /**
     * @param LoginRequest $request
     * @return mixed
     */
    public function login(LoginRequest $request);

    /**
     * @param RegisterRequest $request
     * @return mixed
     */
    public function register(RegisterRequest $request);

    /**
     * @return mixed
     */
    public function logout();

    /**
     * @return mixed
     */
    public function refresh();

    /**
     * @param User $user
     * @return mixed
     */
    public function userProfile();

    /**
     * @return mixed
     */
    public function saveProfile(Request $request);
}
