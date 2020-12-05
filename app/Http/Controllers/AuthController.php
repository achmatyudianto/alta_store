<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Http\Resources\User as UserResource;
use App\User;
use Auth;

class AuthController extends Controller
{
	public function register(Request $request, User $user) 
	{
		$this->validate($request, [
			'name'		=> 'required',
			'email'		=> 'required|email|unique:users',
			'password'	=> 'required|min:6',
		]);

		$user = $user->create([
			'name'		=> $request->name,
			'email'		=> $request->email,
			'api_token'	=> Str::random(60),
			'password'	=> Hash::make($request->password),
		]);

		return new UserResource($user);
	}

	public function login(Request $request, User $user) 
	{
		if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
			return response()->json(['error' => 'Your credential is wrong'], 401);
		}

		$user = Auth::user();

		return new UserResource($user);
	}
}
