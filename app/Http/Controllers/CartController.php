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
        
                    // TEts
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

	public function Delete(Request $request, Cart $cart)
    {
        $this->authorize('delete', $cart);

        $cart->delete();

        return response()->json(json_decode('{"message" : "deleted" }'), 200);
	}
	
	public function Update(Request $request, Cart $cart)
	{
		$this->authorize('update', $cart);

		$cart->qty = $request->get('qty', $cart->qty);
		$cart->save();

		return new CartResource($cart);
	}
}
