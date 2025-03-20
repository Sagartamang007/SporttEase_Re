<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Vendor's Owner Name
            $table->string('company_name');  // Company Name
            $table->string('document');  // Document
            $table->string('pan_card');  // PAN Card Number
            $table->string('pan_card_image');  // PAN Card Image
            $table->string('front_citizenship_document');  // Front Image of Citizenship Document
            $table->string('back_citizenship_document');  // Back Image of Citizenship Document

            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');  // Approval Status
            $table->timestamps();  // Created at and Updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
