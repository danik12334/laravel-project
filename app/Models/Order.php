<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'cart_items', 
        'customer_name',
        'phone', 
        'email', 
        'address', 
        'total', 
        'status'
    ];

    protected $casts = [
        'cart_items' => 'array'
    ];
}