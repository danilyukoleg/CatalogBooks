<?php

namespace App\Http\Controllers;

use App\Models\AddBook;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class Home
{
	public function index()
	{
		$books = AddBook::with([
		"user" => function ($query) {
			$query->select("id", "fio");
		}])->select("id", "name", "cover", "year", "user_id")->simplePaginate(4);

		return Inertia::render("Welcome", [
			"books" => $books
		]);
	}
}
