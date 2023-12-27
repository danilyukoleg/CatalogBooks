<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

	    $admin = Role::where('slug','admin')->first();
	    $administrator = Permission::where('slug','administrator')->first();

	    $user = new User();
	    $user->fio = "Олег Данилюк";
		$user->country = "Россия";
		$user->comment = "Telegram: @danilyuk_2";
	    $user->email = "danilyuk_oleg@vk.com";
	    $user->password = Hash::make("secret222");
	    $user->save();
	    $user->roles()->attach($admin);
	    $user->permissions()->attach($administrator);
    }
}
