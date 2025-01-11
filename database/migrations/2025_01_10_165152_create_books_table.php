<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('books', function (Blueprint $table) {
        $table->id();                    // Primary key
        $table->string('title');         // Book title
        $table->string('author');        // Author's name
        $table->string('isbn')->unique(); // ISBN number
        $table->integer('published_year'); // Year of publication
        $table->text('description')->nullable(); // Optional description
        $table->timestamps();            // Created_at and Updated_at
        $table->softDeletes(); //deleted_at for soft deletes
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
