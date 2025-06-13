<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComingSoonBook extends Model
{
    protected $table = 'coming_soon_books';
    
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