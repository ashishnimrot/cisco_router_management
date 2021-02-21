<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (NotFoundHttpException $exception, $request) {
            return $request->expectsJson()
                ? response()->json(['message' => "Data not found!"], 401)
                : redirect()->guest($exception->redirectTo() ?? route('login'));
        });

        $this->renderable(function (JWTException $exception, $request) {
            return $request->expectsJson()
                ? response()->json(['message' => $exception->getMessage()], 401)
                : redirect()->guest($exception->redirectTo() ?? route('login'));
        });

        $this->renderable(function (MethodNotAllowedHttpException $exception, $request) {
            return $request->expectsJson()
                ? response()->json(['message' => $exception->getMessage()], 405)
                : redirect()->guest($exception->redirectTo() ?? route('login'));
        });
    }

}
