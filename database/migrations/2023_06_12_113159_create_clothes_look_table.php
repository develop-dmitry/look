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
        Schema::create('clothes_look', function (Blueprint $table) {
            $table->foreignId('clothes_id')->references('id')->on('clothes');
            $table->foreignId('look_id')->references('id')->on('looks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clothes_look');
    }
};
