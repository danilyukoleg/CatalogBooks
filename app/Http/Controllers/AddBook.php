<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\AddBook as Book;
use App\Models\Category;

class AddBook extends Controller
{
	public function index()
	{

	   $categories = Category::all();
	   return Inertia::render("AddBooks", [
		   "categories" => $categories
	   ]);
	}

	public function store(Request $request)
	{
		$book = new Book();

		$validator = $request->validate([
			"nameBook" => ["required", "max:255"],
			"imageBook" => ["required", "mimes:jpg,jpeg,png", "max:500"],
			"date" => ["required", "date_format:Y-m-d"],
			"description" => ["required", "max:500"],
			"category_id" => ["required", "exists:categories,id"]
		]);
		$image = $request->file("imageBook");
		$imageName = md5(time()) . "." . $image->getClientOriginalExtension();
		$image->move(public_path("images"), $imageName );
		$imagePath = "/images/" .$imageName;

		$book->name = $request->nameBook;
		$book->year = date("Y", strtotime($request->date));
		$book->cover = $imagePath;
		$book->description = $request->description;
		$book->user_id = Auth::id();
		$book->category_id = $request->category_id;
		$book->save();

		return redirect("/book/{$book->id}");

	}

	public function show($id, Request $request) {

		$book = Book::where("id", $id)->first();
		$author = User::where("id", $book->user_id)->select(["fio"])->first();
		return Inertia::render("DetailsBook", [
			"book" => $book,
			"author" => $author
		]);
	}

}
