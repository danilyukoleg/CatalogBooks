<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("categories")->insert([
			[
				"name" => "Бизнес Книги",
				"slug" => "business",
				"description" => "Категория Бизнес Книг",
				"hide" => null
			],
	        [
		        "name" => "История",
				"slug" => "history",
		        "description" => "Категория Историй",
		        "hide" => null
	        ],
	        [
		        "name" => "Информатика",
				"slug" => "computer-science",
		        "description" => "Категория Информатики",
		        "hide" => null
	        ],
        ]);
    }
}
