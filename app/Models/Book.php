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
        'authors',
        'isbn',
        'published_year',
        'description',
        'is_borrowed',
    ];

    public function borrows()
    {
    return $this->hasMany(Borrow::class);
    }

    public function authors()
    {   
    return $this->belongsToMany(Author::class);
    }

}
