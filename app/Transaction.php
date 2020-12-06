<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'id', 'user_id', 'paid',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function transaction_details()
    {
        return $this->hasMany(TransactionDetail::class, 'id');
    }
}
