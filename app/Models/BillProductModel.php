<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductModel as Product;
use App\Models\BillModel as Bill;

class BillProductModel extends Model
{
	use HasFactory;

	protected $table = 'bill_product';

	protected $fillable = [
		'id_bill',
		'product_description',
		'product_category',
		'product_price',
		'quantity',
		'total'
	];

	public function product()
	{
		return $this->belongsTo(Product::class,'id_product');
	}
	public function bill()
	{
		return $this->belongsTo(Bill::class,'id_bill');
	}
}
