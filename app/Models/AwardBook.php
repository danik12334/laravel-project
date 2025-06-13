<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AwardBook extends Model
{
    protected $table = 'award_books';
    
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
