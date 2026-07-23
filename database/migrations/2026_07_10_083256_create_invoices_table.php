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
        Schema::create('invoices', function (Blueprint $table) {

            $table->id();

            // Employee
            $table->foreignId('employee_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Invoice Details
            $table->string('invoice_number')->unique();
            $table->date('invoice_date');
            $table->date('due_date');

            // Payment
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('tax', 12, 2)->default(0);
            $table->decimal('discount', 12, 2)->default(0);
            $table->decimal('total_amount', 12, 2)->default(0);

            // Status
            $table->enum('status', [
                'Pending',
                'Paid',
                'Overdue',
                'Cancelled'
            ])->default('Pending');

            // Payment Method
            $table->enum('payment_method', [
                'Cash',
                'Bank Transfer',
                'UPI',
                'Cheque',
                'Card'
            ])->nullable();

            // Extra Information
            $table->text('notes')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};