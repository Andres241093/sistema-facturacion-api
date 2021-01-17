<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductModel as Products;

class CategoryModel extends Model
{
	use HasFactory;

	protected $table = 'categories';

	protected $fillable = ['name'];

	public function products()
	{
		$this->hasMany(Products::class);
	}
}
