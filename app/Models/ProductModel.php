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

	protected $visible = [
		'id',
		'description',
		'price',
		'created_at',
        'updated_at',
		'category'
	];

	public function category()
	{
		return $this->belongsTo(Category::class,'id_category');
	}

	public function billProduct()
	{
		return $this->hasMany(BillProduct::class);
	}
}
