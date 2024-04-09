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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['INDIVIDUAL', 'BUSINESS', 'OTHERS']);
            $table->enum('title', ['MR', 'MISS', 'M/S']);
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('id_type', ['TRADE_LICENCE', 'NATIONAL_ID', 'PASSPORT', 'OTHERS']);
            $table->string('id_number');
            $table->string('contact_name');
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->string('contact_phone2');
            $table->string('address_line1');
            $table->string('address_line2');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('zip');
            $table->enum('status', ['ACTIVE', 'DORMANT', 'DELETED', 'PENDING']);
            $table->boolean('is_deleted')->default(false);
            $table->foreignId('company_id')->constrained('company_profiles');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
