<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminCategory extends Controller
{
	public function index()
	{
		$category = Category::all();
		return Inertia::render("Admin/Category", [
			"categories" => $category
		]);
	}

	public function create(Request $request)
	{
		$validation = $request->validate([
			"name" => ["required", "unique:categories", "max:150"],
			"slug" => ["required", "unique:categories", "max:150"],
			"description" => ["required", "max:500"]
		]);

		$category = new Category();
		$category->name = $request->input("name");
		$category->slug = $request->input("slug");
		$category->description = $request->input("description");
		$category->save();

		$request->session()->flash("message", "Успешно добавлено");
	}

	public function update($slug, Request $request)
	{
		$category = Category::where("slug", $slug)->first();
		$category->hide = $request->hidden;
		$category->save();
		$request->session()->flash("message", "Успешно обновлено");
	}

	public function edit($slug, Request $request)
	{
		$validation = $request->validate([
			"name" => ["required", "unique:categories", "max:150"],
			"slug" => ["required", "unique:categories" ,"max:150"],
			"description" => ["required", "max:500"]
		]);
		$category = Category::where("slug", $slug)->first();

		$category->name = $request->name;
		$category->slug = $request->slug;
		$category->description = $request->description;

		$category->save();


		$request->session()->flash("message", "Успешно обновлено");

	}

	public function destroy($slug, Request $request)
	{
		$category = Category::where("slug", $slug)->first()->delete();
		$request->session()->flash("message", "Удалено");
	}
}
