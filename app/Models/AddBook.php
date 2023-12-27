<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddBook extends Model
{
    use HasFactory;

	public function category()
	{
		return $this->belongsToMany(Category::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class, "user_id");
	}
}
