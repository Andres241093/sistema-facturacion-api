<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryModel as Category;
use App\Models\BillProductModel as BillProduct;

class ProductModel extends Model
{
	use HasFactory;

	protected $table = 'products';

	protected $fillable = ['description','price','id_category'];

	public function category()
	{
		$this->belongsTo(Category::class);
	}

	public function billProduct()
	{
		$this->hasMany(BillProduct::class);
	}
}
