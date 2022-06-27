<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// product route;
Route::get('products-', ['as' => 'data', 'uses' => 'App\Http\Controllers\ProductController@getData']);
Route::resource('products', ProductController::class);

// home route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// category route 
Route::resource('categories', CategoryController::class);
Route::get('category', ['as' => 'category', 'uses' => 'App\Http\Controllers\CategoryController@getData']);

Route::group(['middleware' => ['admin']], function () {

// User route 
Route::resource('users',UserController::class);
Route::get('user', ['as' => 'user', 'uses' => 'App\Http\Controllers\UserController@getData']);
});