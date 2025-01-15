<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'phone'];

    // One-to-Many relationship with books
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    // Polymorphic relationship for reviews
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}

