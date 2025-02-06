<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('resumes', function (Blueprint $table) {
            $table->string('error_type')->nullable(); // Add the error_type column
        });
    }

    public function down(): void
    {
        Schema::table('resumes', function (Blueprint $table) {
            $table->dropColumn('error_type'); // Drop the column if rolling back
        });
    }
};