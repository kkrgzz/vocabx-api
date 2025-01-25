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
        Schema::create('words', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('language_code');
            $table->string('word');
            $table->timestamps();

            $table->foreign('language_code')
                ->references('code')
                ->on('languages')
                ->onDelete('cascade');


            // Add index for faster word searches
            $table->index('word');

            // Add compound index for language+word lookups
            $table->unique(['language_code', 'word']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('words');
    }
};
