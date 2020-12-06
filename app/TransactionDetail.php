<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $table = 'transaction_details';

    protected $fillable = [
        'id', 'user_id', 'transaction_id', 'product_id', 'product_name', 'price', 'qty',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
