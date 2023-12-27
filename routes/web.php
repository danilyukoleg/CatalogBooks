<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddBook;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Home;
use \App\Http\Controllers\Category;
use App\Http\Controllers\Admin\AdminCategory;
use App\Http\Controllers\Admin\AdminAuthorController;
use App\Http\Controllers\Admin\AdminBookController;
use App\Http\Controllers\BookController;
use \App\Http\Controllers\SearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Home::class, "index"]);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('book', AddBook::class)->only(["index","store", "show"])->middleware("auth");

Route::get("/category/{slug}", [Category::class, "index"]);

Route::get("/search", [SearchController::class, "index"]);

Route::get("/logout", function () {
	Auth::logout();
	return redirect("/");
})->name("logout");
Route::resource("books", BookController::class)->middleware("auth");



Route::middleware(["auth","verified", "role:admin"])->prefix("dashboard")->group(function () {
	Route::get('/', function () {
		return Inertia::render('Dashboard');
	});

	Route::resource("category", AdminCategory::class);
	Route::resource("author", AdminAuthorController::class)->names([
		"store" => "dashboard.author.store",
		"edit" => "dashboard.author.edit",
		"update" => "dashboard.author.update"
	]);
	Route::resource("book", AdminBookController::class)->only(["index", "edit", "update", "destroy"]);
});

require __DIR__.'/auth.php';
