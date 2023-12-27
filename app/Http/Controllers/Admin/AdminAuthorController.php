<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class AdminAuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		$users = User::select("id", "fio", "email")->get();

        return Inertia::render("Admin/Author", [
			"users" => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
	public function store(Request $request): RedirectResponse
	{
		$request->validate([
		'fio' => 'required|string|max:150',
		'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
		'password' => ['required', 'confirmed', Password::defaults()],
		'country'=> ['required', 'max:100'],
		'comment' => ['max:500']
		]);

		$user = User::create([
		'fio' => $request->fio,
		'email' => $request->email,
		'password' => Hash::make($request->password),
		'country' => $request->country,
		'comment' => $request->comment,
		]);


		$request->session()->flash("message", "Успешно обновлено");

		return redirect()->route("dashboard.author.store");
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
    public function edit(Request $request, string $id)
    {
		$user = User::find($id);

	   return Inertia::render("Admin/UpdateAuthor", [
		   "user" => $user
	   ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
		$user = User::find($id);

		$user->fio = $request->fio;
		$user->email = $request->email;
		$user->comment = $request->comment;

		$user->save();

	    $request->session()->flash("message", "Успешно обновлено");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
