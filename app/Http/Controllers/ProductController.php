<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\Product as ProductResource;
use App\Product;

class ProductController extends Controller
{
	public function Product(Request $request, Product $product)
	{
		if ($request->category_id <> "") {
			$product = $product
					->where('category_id', $request->category_id)
					->get();
		} else {
			$product = $product->all();
		}

		return ProductResource::collection($product);
	}
}
