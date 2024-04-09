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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['sale', 'rent','lease']);
            $table->enum('status',['active','expired','terminated', 'draft', 'pending', 'approved', 'rejected']);
            $table->string('start_date');
            $table->string('end_date')->nullable();
            $table->integer('price');
            $table->string('payment_frequency');
            $table->string('remarks')->nullable();
            $table->string('comment')->nullable();
            $table->enum('payment_method',['cash','cheque','bank_transfer','credit_card','other']);
            $table->enum('payment_status',['paid','unpaid','partial']);
            $table->foreignId('property_id')->constrained('properties');
            $table->foreignId('owner_id')->constrained('customers');
            $table->foreignId('customer_id')->nullable()->constrained('customers');
            $table->foreignId('agent_id')->constrained('users');
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
        Schema::dropIfExists('contracts');
    }
};
