<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		DB::table("roles")->insert([
			[
				"name" => "Admin",
				"slug" => "admin"
			],
			[
				"name" => "User",
				"slug" => "user"
			]
		]);
    }
}
