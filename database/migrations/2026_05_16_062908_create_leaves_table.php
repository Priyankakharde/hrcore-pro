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
        Schema::create('leaves', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Employee Information
            |--------------------------------------------------------------------------
            */

            $table->string('employee_name');
            $table->string('employee_id');
            $table->string('department')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Leave Information
            |--------------------------------------------------------------------------
            */

            $table->string('leave_type');

            $table->date('start_date');

            $table->date('end_date');

            $table->integer('total_days')->default(1);

            /*
            |--------------------------------------------------------------------------
            | Leave Status
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'Pending',
                'Approved',
                'Rejected'
            ])->default('Pending');

            /*
            |--------------------------------------------------------------------------
            | Priority
            |--------------------------------------------------------------------------
            */

            $table->enum('priority', [
                'Low',
                'Medium',
                'High'
            ])->default('Medium');

            /*
            |--------------------------------------------------------------------------
            | Leave Details
            |--------------------------------------------------------------------------
            */

            $table->text('reason')->nullable();

            $table->text('admin_note')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Leave Balance
            |--------------------------------------------------------------------------
            */

            $table->integer('remaining_leave')->default(20);

            /*
            |--------------------------------------------------------------------------
            | Applied Date
            |--------------------------------------------------------------------------
            */

            $table->date('applied_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};