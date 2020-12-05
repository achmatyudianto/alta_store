<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//auth user
Route::post('auth/register', 'AuthController@Register');
Route::post('auth/login', 'AuthController@Login');
//category
Route::get('category', 'CategoryController@FetchAllCategory');
Route::get('product', 'ProductController@Product');

Route::group(['middleware' => 'auth:api'], function(){
	//cart
	Route::post('cart', 'CartController@Store');
	Route::get('cart', 'CartController@FecthAllCart');
	Route::put('cart/{cart}', 'CartController@Update');
	Route::delete('cart/{cart}', 'CartController@Delete');
});