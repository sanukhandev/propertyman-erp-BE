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
        Schema::create('interactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('company_id')->constrained('company_profiles');
            $table->foreignId('customer_id')->constrained('customers');
            $table->enum('type', ['call', 'email', 'meeting', 'other']);
            $table->enum('status', ['pending', 'completed', 'cancelled']);
            $table->string('remarks')->nullable();
            $table->dateTime('interaction_date')->nullable();
            $table->string('interaction_notes')->nullable();
            $table->enum('interaction_result',['positive', 'negative', 'neutral']);
            $table->string('interaction_summary')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interactions');
    }
};
