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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question', 191)->unique();
            $table->string('answer', 255);
            $table->string('opt_1', 255);
            $table->string('opt_2', 255);
            $table->string('opt_3', 255);
            $table->foreignId('user_id')->nullable();
            $table->integer('score')->unsigned();
            $table->foreignId('category_id');
            $table->timestamps();

            // Define foreign key constrait
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
