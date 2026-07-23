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
        Schema::create('salaries', function (Blueprint $table) {

            $table->id();

            // Employee Relationship
            $table->foreignId('employee_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Salary Structure
            $table->decimal('basic_salary', 12, 2);

            $table->decimal('bonus', 12, 2)
                  ->default(0);

            $table->decimal('overtime_amount', 12, 2)
                  ->default(0);

            $table->decimal('tax', 12, 2)
                  ->default(0);

            $table->decimal('deduction', 12, 2)
                  ->default(0);

            $table->decimal('net_salary', 12, 2);

            // Payroll Period
            $table->string('month');

            // Payment Details
            $table->string('payment_method')
                  ->default('Bank Transfer');

            $table->enum('payment_status', [
                'Pending',
                'Paid',
                'Failed'
            ])->default('Pending');

            $table->date('payment_date')
                  ->nullable();

            // Extra Information
            $table->text('notes')
                  ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};