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

	public function product()
	{
		$this->belongsTo(Product::class);
	}
	public function bill()
	{
		$this->belongsTo(Bill::class);
	}
}
