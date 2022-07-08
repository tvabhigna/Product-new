<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AuthController;
// use Auth;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[AuthController::class,'login']);

Auth::routes();

//All secure URL's
Route::get( 'users', [ UserController::class, 'index' ] );
Route::post( 'user/create', [ UserController::class, 'create' ]);
Route::get( 'user/{id}/show',[ UserController::class, 'show']);
Route::post( 'user/{id}/update', [ UserController::class, 'update' ]);
Route::delete( 'user/delete/{id}', [ UserController::class, 'delete' ]);