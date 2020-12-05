<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//auth user
Route::post('auth/register', 'AuthController@register');
Route::post('auth/login', 'AuthController@login');