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
        Schema::create('tasks', function (Blueprint $table) {

            $table->id();

            // TASK DETAILS
            $table->string('title');

            $table->longText('description')
                  ->nullable();

            // ASSIGNED EMPLOYEE
            $table->string('employee');

            // PRIORITY
            $table->enum('priority', [
                'High',
                'Medium',
                'Low'
            ])->default('Medium');

            // TASK STATUS
            $table->enum('status', [
                'To Do',
                'In Progress',
                'Review',
                'Completed'
            ])->default('To Do');

            // DEADLINE
            $table->date('due_date');

            // OPTIONAL FEATURES
            $table->integer('progress')
                  ->default(0);

            $table->boolean('is_completed')
                  ->default(false);

            $table->timestamp('completed_at')
                  ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};