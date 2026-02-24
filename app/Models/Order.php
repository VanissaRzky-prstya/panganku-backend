<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'invoice_id',
        'subtotal',
        'ongkir',
        'total',
        'status',
        'alamat',
        'cart',
        'pengiriman',
        'catatan',
    ];
    protected $casts=[
        'alamat' => 'array',
    ];

}
