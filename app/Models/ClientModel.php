<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\BillModel as Bills;

class ClientModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'clients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'dni',
        'address',
        'phone',
    ];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'name',
        'dni',
        'address',
        'phone',
        'created_at',
        'updated_at'
    ];

    public function bills()
    {
        return $this->hasMany(Bills::class);
    }

}
