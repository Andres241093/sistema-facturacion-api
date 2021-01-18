<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\BillProductModel as BillProduct;

class BillModel extends Model
{
    use HasFactory;

    protected $table = 'bills';

    protected $fillable = ['id_user','total','date'];

    public function user()
    {
    	return $this->belongsTo(User::class,'id_user');
    }

    public function billProduct()
    {
        return $this->hasMany(BillProduct::class);
    }
}
