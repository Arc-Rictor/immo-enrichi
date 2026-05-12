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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->longText('description')->nullable();
            $table->longText('specification')->nullable();
            $table->string('address_line_one');
            $table->string('address_line_two')->nullable();
            $table->string('city');
            $table->string('province');
            $table->string('postcode');
            $table->string('country');
            $table->string('property_type');
            $table->string('property_size');
            $table->string('land_size');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->integer('asking_price');
            $table->string('status');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
