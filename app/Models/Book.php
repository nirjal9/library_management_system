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
        'publisher_id'
    ];

    public function borrows()
    {
    return $this->hasMany(Borrow::class);
    }

    public function authors()
    {   
    return $this->belongsToMany(Author::class);
    }

    //One-to-Many relationship with publisher
    public function publisher()
    {   
    return $this->belongsTo(Publisher::class);
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

}
