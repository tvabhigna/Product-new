<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\Auth\LoginController;

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
Route::post('login',[LoginController::class,'login']);

// product route;
Route::get('product-data', ['as' => 'products.data', 'uses' => 'App\Http\Controllers\ProductController@getData']);
Route::resource('products', ProductController::class);

// home route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// category route 
Route::resource('categories', CategoryController::class);
Route::get('category-data', ['as' => 'categories.data', 'uses' => 'App\Http\Controllers\CategoryController@getData']);

// Admin Login for user
Route::group(['middleware' => ['admin']], function () {
// User route 
Route::resource('users',UserController::class);
Route::get('user-data', ['as' => 'users.data', 'uses' => 'App\Http\Controllers\UserController@getData']);
});

// Brand route
Route::resource('brands',BrandController::class);
Route::get('brand-data', ['as' => 'brands.data', 'uses' => 'App\Http\Controllers\BrandController@getData']);
Route::get('image/', ['as' => 'brands.image', 'uses' => 'App\Http\Controllers\BrandController@showImage']);
