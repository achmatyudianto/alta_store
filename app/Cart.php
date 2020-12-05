<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
	protected $table = 'carts';

	protected $fillable = [
		'id', 'user_id', 'product_id', 'qty', 
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function product()
	{
		return $this->belongsTo(Product::class, 'product_id');
	}
}
