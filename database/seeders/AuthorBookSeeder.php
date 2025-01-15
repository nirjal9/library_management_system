<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorBookSeeder extends Seeder
{
    public function run()
    {
        DB::table('author_book')->insert([
            ['book_id' => 1, 'author_id' => 1],
            ['book_id' => 1, 'author_id' => 2],
            ['book_id' => 2, 'author_id' => 3],
            // Add more entries as needed
        ]);
    }
}

