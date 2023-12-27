<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\AddBook;

class SearchController extends Controller
{
    public function index(Request $request)
    {
		$books = AddBook::with([
			"user" => function ($query) {
				$query->select("id", "fio");
			}])->whereFullText(["name"], $request->input("search"))->get();
		return Inertia::render("Search", [
			"books" => $books,
			"slug" => $request->input("search"),
		]);
    }
}

