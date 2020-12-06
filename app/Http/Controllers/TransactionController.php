<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\Transaction as TransactionResource;
use App\Transaction;
use App\TransactionDetail;
use App\Cart;
use Auth;

class TransactionController extends Controller
{
    public function Checkout(Request $request, Transaction $transaction, TransactionDetail $transactiondetail, Cart $cart)
    {
        $request = json_decode($request->getContent(), true);
        $transaction = $transaction->create([
            'user_id'   => Auth::user()->id,
            'paid'      => '0',
        ]);

        foreach ($request['data'] as $value) {
            $cart = $cart->select('id','product_id','qty')
                            ->where('user_id', Auth::user()->id)
                            ->where('id', $value['id'])
                            ->first();

            $transactiondetail = $transactiondetail->create([
                'user_id'           => Auth::user()->id,
                'transaction_id'    => $transaction->id,
                'product_id'        => $cart->product_id,
                'product_name'      => $cart->product->product_name,
                'price'             => $cart->product->price,
                'qty'               => $cart->qty,
            ]);

            $cart->delete();
        }

        return new TransactionResource($transaction);
    }

    public function FecthAllTransaction(Request $request, Transaction $transaction)
    {
        $transaction = $transaction
                        ->where('user_id', Auth::user()->id)
                        ->where('paid', false)
                        ->get();

        return TransactionResource::collection($transaction);
    }

    public function Payment(Request $request, Transaction $transaction)
	{
		$this->authorize('payment', $transaction);

		$transaction->paid = true;
		$transaction->save();

		return new TransactionResource($transaction);
    }
    
    public function FecthAllPayment(Request $request, Transaction $transaction)
    {
        $transaction = $transaction
                        ->where('user_id', Auth::user()->id)
                        ->where('paid', true)
                        ->get();

        return TransactionResource::collection($transaction);
    }
}
