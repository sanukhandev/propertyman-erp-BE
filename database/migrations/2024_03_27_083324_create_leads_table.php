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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('company_id')->constrained('company_profiles');
            $table->foreignId('customer_id')->constrained('customers');
            $table->enum('source', ['website', 'phone', 'email', 'walk_in', 'social_media', 'other']);
            $table->enum('status', ['new', 'contacted', 'qualified', 'lost', 'cancelled']);
            $table->string('remarks')->nullable();
            $table->string('comment')->nullable();
            $table->dateTime('contact_date')->nullable();
            $table->dateTime('next_follow_up')->nullable();
            $table->string('follow_up_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
