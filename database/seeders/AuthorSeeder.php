<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        Author::create(['name' => 'Author 1']);
        Author::create(['name' => 'Author 2']);
        Author::create(['name' => 'Author 3']);
    }
}

