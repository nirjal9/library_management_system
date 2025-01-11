<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Import SoftDeletes trait

class Book extends Model
{
    use HasFactory, SoftDeletes;//Enable soft deletes
    
    protected $fillable = [
        'title',
        'author',
        'isbn',
        'published_year',
        'description',
    ];
}
