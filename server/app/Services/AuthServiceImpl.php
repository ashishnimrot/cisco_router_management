<?php


namespace App\Services;


use App\Contracts\AuthRepositoryContract;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Responses\Auth\AuthLoginResponse;
use App\Http\Responses\Auth\AuthLogoutResponse;
use App\Http\Responses\Auth\AuthProfileResponse;
use App\Http\Responses\Auth\AuthRefreshResponse;
use App\Http\Responses\Auth\AuthRegisterResponse;
use App\Http\Responses\Auth\SaveProfileResponse;
use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

class AuthServiceImpl implements AuthService
{

    /**
     * @var AuthRepositoryContract
     */
    private AuthRepositoryContract $authRepository;

    /**
     * AuthServiceImpl constructor.
     * @param AuthRepositoryContract $authRepository
     */
    public function __construct(AuthRepositoryContract $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * @param LoginRequest $request
     * @return Responsable
     */
    public function login(LoginRequest $request)
    {
        return new AuthLoginResponse($this->authRepository->login($request));
    }

    /**
     * @param RegisterRequest $request
     * @return Responsable
     */
    public function register(RegisterRequest $request)
    {
        return new AuthRegisterResponse($this->authRepository->register($request));
    }

    /**
     * @return Responsable
     */
    public function logout()
    {
        $this->authRepository->logout();
        return new AuthLogoutResponse([]);
    }

    /**
     * @return Responsable
     */
    public function refresh()
    {
        return new AuthRefreshResponse($this->authRepository->createNewToken(auth()->refresh()));
    }

    /**
     * @param User $user
     * @return Responsable
     */
    public function userProfile()
    {
        return new AuthProfileResponse($this->authRepository->profile());
    }

    /**
     * @return Responsable
     */
    public function saveProfile(Request $request)
    {
        $user = auth()->user();
        return new SaveProfileResponse($this->authRepository->update($request->all(), $user));
    }
}
