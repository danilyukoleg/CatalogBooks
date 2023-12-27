<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		DB::table("permissions")->insert([
			[
				"name" => "article",
				"slug" => "article"
			],
			[
				"name" => "administrator",
				"slug" => "administrator"
			]
		]);
    }
}
