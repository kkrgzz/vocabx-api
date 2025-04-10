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
        Schema::table('sentences', function (Blueprint $table) {
            $table->boolean('is_ai_generated')->default(0)->after('sentence');
            $table->string('ai_review', 1000)->nullable()->after('is_ai_generated');
            $table->decimal('ai_elapsed_time', 10, 2)->nullable()->after('ai_review');
            $table->unsignedInteger('ai_prompt_tokens')->nullable()->after('ai_elapsed_time');
            $table->unsignedInteger('ai_completion_tokens')->nullable()->after('ai_prompt_tokens');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sentences', function (Blueprint $table) {
            $table->dropColumn('is_ai_generated');
            $table->dropColumn('ai_review');
            $table->dropColumn('ai_elapsed_time');
            $table->dropColumn('ai_prompt_tokens');
            $table->dropColumn('ai_completion_tokens');
        });
    }
};
