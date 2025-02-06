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
        Schema::table('interview_responses', function (Blueprint $table) {
            $table->float('confidence_score')->nullable(); // Add confidence_score column
            $table->float('clarity_score')->nullable();    // Add clarity_score column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('interview_responses', function (Blueprint $table) {
            $table->dropColumn(['confidence_score', 'clarity_score']); // Drop columns if rolling back
        });
    }
};