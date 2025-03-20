<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->date('date');  // To store the selected date
            $table->string('start_time');  // To store the selected start time
            $table->string('end_time');  // To store the selected end time
            $table->string('user_name');  // To store the logged-in user's name
            $table->timestamps();  // Automatically adds created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
