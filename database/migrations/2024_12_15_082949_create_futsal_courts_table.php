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
        Schema::create('futsal_courts', function (Blueprint $table) {
            $table->id();
            $table->string('futsal_name');
            $table->string('futsal_location');
            $table->string('futsal_description');
            $table->string('num_court');
            $table->string('opening_time');
            $table->string('closing_time');
            $table->integer('hourly_price');
            $table->string('futsal_image')->nullable();
            $table->foreignId('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('futsal_courts');
    }
};
