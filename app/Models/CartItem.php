<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'user_id', 'book_type', 'book_id', 
        'title', 'price', 'image', 'quantity'
    ];
}