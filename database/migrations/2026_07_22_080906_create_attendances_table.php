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
        Schema::create('attendances', function (Blueprint $table) {

            $table->id();

            // Employee
            $table->foreignId('employee_id')
                ->constrained()
                ->onDelete('cascade');

            // Attendance Date
            $table->date('attendance_date');

            // Time
            $table->time('check_in')->nullable();
            $table->time('check_out')->nullable();

            // Working Hours
            $table->decimal('working_hours',5,2)->default(0);

            // Overtime
            $table->decimal('overtime_hours',5,2)->default(0);

            // Break
            $table->decimal('break_hours',5,2)->default(0);

            // Shift
            $table->enum('shift',[
                'Morning',
                'Afternoon',
                'Evening',
                'Night'
            ])->default('Morning');

            // Status
            $table->enum('status',[
                'Present',
                'Absent',
                'Leave',
                'Half Day',
                'Holiday'
            ])->default('Present');

            // Location
            $table->string('location')->nullable();

            // Device
            $table->string('device')->nullable();

            // IP Address
            $table->string('ip_address')->nullable();

            // Notes
            $table->text('notes')->nullable();

            // Marked By
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->unique([
                'employee_id',
                'attendance_date'
            ]);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};