<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->text('content'); // Review content
            $table->integer('rating'); // Rating (e.g., 1-5 stars)
            $table->unsignedBigInteger('reviewable_id'); // Polymorphic relation ID
            $table->string('reviewable_type'); // Polymorphic relation type
            $table->unsignedBigInteger('user_id'); // The user who wrote the review
            $table->timestamps();

            // Foreign key constraint for user
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
