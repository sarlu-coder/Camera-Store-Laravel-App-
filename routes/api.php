<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('register','AuthController@register');
Route::post('login','AuthController@login');
Route::group(['middleware' => ['auth:api']], function () {
	Route::get('list-categories','StoreController@listCategories');
	Route::post('list-products','StoreController@listProducts');
	Route::post('add-to-cart','StoreController@addProductToCart');
	Route::get('list-cart','StoreController@listCart');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


