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
        Schema::create('studies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('target_type');
            $table->string('target');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->time('Duration')->nullable();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('reference_id')->references('id')->on('references');
            $table->foreignId('chapter_id')->references('id')->on('chapters');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studies');
    }
};
