<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExclusiveBook extends Model
{
    protected $table = 'exclusive_books';
    
    protected $fillable = [
        'image',
        'title',
        'author',
        'description',
        'publisher',
        'series',
        'year',
        'isbn',
        'price',
        'quantity',
        'added_by'
    ];
}