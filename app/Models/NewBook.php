<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewBook extends Model
{
    protected $table = 'new_books';
    
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
