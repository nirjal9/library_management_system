<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Publisher;

class PublishersTableSeeder extends Seeder
{
    public function run()
    {
        Publisher::create(['name' => 'Penguin Random House']);
        Publisher::create(['name' => 'HarperCollins']);
        Publisher::create(['name' => 'Simon & Schuster']);
    }
}

