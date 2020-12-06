<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $table = 'products';

	protected $fillable = [
		'id', 'category_id' ,'product_name', 'note', 'price', 
	];

	public function category()
	{
		return $this->belongsTo(Category::class, 'category_id');
	}

	public function carts()
	{
		return $this->hasMany(Cart::class, 'id');
	}

	public function transaction_detail()
	{
		return $this->hasMany(TransactionDetail::class, 'id');
	}
}
