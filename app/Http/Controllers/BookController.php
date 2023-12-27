<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\AddBook;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		$books = AddBook::where("user_id", Auth::id())->get();
        return Inertia::render("MyBooks", [
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

	    return Inertia::render("MyUpdateBook", [
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
