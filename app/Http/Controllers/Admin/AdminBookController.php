<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AddBook;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		$books = AddBook::with([
			"user" => function ($query) {
				$query->select("id", "fio");
			}])->select("id", "name", "cover", "year", "user_id")->get();

        return Inertia::render("Admin/Book", [
			"books" => $books
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = AddBook::find($id);

		return Inertia::render("Admin/UpdateBook", [
			"book" => $book
		]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
	    $book = AddBook::find($id);
	    $image = $request->file("cover");
	    if ($image) {
		    $imageName = md5(time()) . "." . $image->getClientOriginalExtension();
		    $image->move(public_path("images"), $imageName );
		    $imagePath = "/images/" .$imageName;
		    $book->cover = $imagePath;

	    } else {
		    $book->cover = $request->cover;
	    }


	    $book->name = $request->name;
		$book->year = $request->year;
		$book->description = $request->description;
		$book->save();

	    $request->session()->flash("message", "Успешно обновлено");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
		$book = AddBook::find($id)->delete();
	    $request->session()->flash("message", "Успешно Удалено");
    }
}
