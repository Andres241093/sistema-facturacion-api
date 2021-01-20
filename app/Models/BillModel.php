<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\BillProductModel as BillProduct;
use App\Models\ClientModel as Client;

class BillModel extends Model
{
    use HasFactory;

    protected $table = 'bills';

    protected $fillable = ['id_user','id_client','total','date'];

    public function user()
    {
    	return $this->belongsTo(User::class,'id_user');
    }

    public function client()
    {
        return $this->belongsTo(Client::class,'id_client');
    }

    public function billProduct()
    {
        return $this->hasMany(BillProduct::class,'id_bill');
    }
}
