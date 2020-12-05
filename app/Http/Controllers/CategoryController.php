<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\Category as CategoryResource;
use App\Category;

class CategoryController extends Controller
{
	public function FetchAllCategory(Request $request, Category $category) 
	{
		$category = $category->all();

		return CategoryResource::collection($category);
	}
}
