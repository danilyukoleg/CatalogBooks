<?php

namespace App\Http\Controllers;

use App\Models\Category as Categories;
use Inertia\Inertia;
use App\Models\AddBook;

class Category
{
	public function index($slug)
	{
		$categories = Categories::where("slug", $slug)->first();

		return Inertia::render("Book", [
			"categories" => $categories,
			"books" => $categories->book
		]);
	}

}
