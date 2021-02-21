<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('ashish', function (){
    return "ashish";
});

Route::group([
//    'middleware' => 'auth:api',
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
});


Route::group(['middleware' => 'api'], function () {
    // User Profiles
    Route::get('profile', [AuthController::class, 'userProfile']);
    Route::post('profile', [AuthController::class, 'saveProfile']);

    // Router API
    Route::apiResource('router', RouterController::class);
    Route::put('router/update/{ip}', [RouterController::class, 'update']);
    Route::delete('router/update/{ip}', [RouterController::class, 'destroy']);
    Route::get('router/update', [RouterController::class, 'destroy']);
    Route::post('router/range', [RouterController::class, 'getListByRange']);
    Route::post('/router/filter', [RouterController::class, 'filter']);
});

