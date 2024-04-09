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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['sale', 'purchase', 'vendor', 'work','other']);
            $table->string('order_number');
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('company_id')->constrained('company_profiles');
            $table->enum('status', ['pending', 'approved', 'rejected']);
            $table->enum('payment_status', ['paid', 'unpaid', 'partial']);
            $table->enum('payment_method', ['cash', 'cheque', 'bank_transfer', 'credit_card', 'other']);
            $table->integer('total');
            $table->string('remarks')->nullable();
            $table->string('comment')->nullable();
            $table->string('payment_date')->nullable();
            $table->string('payment_due_date')->nullable();
            $table->string('payment_reference')->nullable();
            $table->string('payment_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
