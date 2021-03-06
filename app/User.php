<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Cart;
use App\Transaction;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'password', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class, 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transactions::class, 'id');
    }

    public function transaction_details()
    {
        return $this->hasMany(TransactionDetail::class, 'id');
    }

    public function ownsCart(Cart $cart) {
        return auth()->id() == $cart->user_id;
    }
    
    public function ownsTransaction(Transaction $transaction) {
        return auth()->id() == $transaction->user_id;
    }
}
