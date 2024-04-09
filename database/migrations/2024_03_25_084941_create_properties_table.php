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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('zip');
            $table->string('gps_coordinates');
            $table->enum('property_type', ['apartment', 'house', 'commercial', 'land', 'other']);
            $table->integer('no_of_bedrooms');
            $table->integer('no_of_bathrooms');
            $table->integer('no_of_floors');
            $table->integer('no_of_parking');
            $table->integer('area');
            $table->string('price_if_sale');
            $table->string('price_if_rent');
            $table->enum('listing_type', ['sale', 'rent']);
            $table->string('status');
            $table->foreignId('company_id')->constrained('company_profiles');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('customer_id')->constrained('customers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
