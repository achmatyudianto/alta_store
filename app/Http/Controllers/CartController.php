<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\Cart as CartResource;
use App\Cart;
use Auth;

class CartController extends Controller
{
	public function Store(Request $request, Cart $cart)
	{
		$this->validate($request, [
			'product_id'	=> 'required',
			'qty'			=> 'required',
		]);

		$cart = $cart->create([
			'user_id'		=> Auth::user()->id,
			'product_id'	=> $request->product_id,
			'qty'			=> $request->qty,
		]);

		return new CartResource($cart);
	}

	public function FecthAllCart(Request $request, Cart $cart)
	{
		$cart = $cart
					->where('user_id', Auth::user()->id)
					->get();

		return CartResource::collection($cart);
	}
}
