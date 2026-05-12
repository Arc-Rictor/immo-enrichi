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
        Schema::table('favourite_listings', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('listing_id')->references('id')->on('listings')->onDelete('cascade');

            // Unique constraint to ensure a user can't favorite the same listing multiple times.
            $table->unique(['user_id', 'listing_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('favourite_listings', function (Blueprint $table) {
            //
        });
    }
};
