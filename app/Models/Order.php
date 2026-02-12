<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'alamat',
        'pengiriman',
        'subtotal',
        'ongkir',
        'total',
        'status'
    ];
    protected $casts=[
        'alamat' => 'array',
    ];

}
