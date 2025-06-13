<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BestBook extends Model
{
    protected $table = 'best_books';
    
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