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
        Schema::dropIfExists('cover_letters');//
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('cover_letters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('job_title');
            $table->string('company_name');
            $table->text('job_description');
            $table->text('cover_letter');
            $table->timestamps();
        });
    }
};
