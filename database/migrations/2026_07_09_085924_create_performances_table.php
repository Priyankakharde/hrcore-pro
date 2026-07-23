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
        Schema::create('performances', function (Blueprint $table) {

            $table->id();

            // Employee
            $table->foreignId('employee_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Review Period
            $table->string('review_month');
            $table->year('review_year');

            // Performance Scores
            $table->unsignedTinyInteger('attendance')->default(0);
            $table->unsignedTinyInteger('task_completion')->default(0);
            $table->unsignedTinyInteger('productivity')->default(0);
            $table->unsignedTinyInteger('communication')->default(0);
            $table->unsignedTinyInteger('teamwork')->default(0);
            $table->unsignedTinyInteger('leadership')->default(0);
            $table->unsignedTinyInteger('problem_solving')->default(0);
            $table->unsignedTinyInteger('punctuality')->default(0);
            $table->unsignedTinyInteger('discipline')->default(0);
            $table->unsignedTinyInteger('innovation')->default(0);
            $table->unsignedTinyInteger('learning')->default(0);

            // Final Result
            $table->decimal('overall_score', 5, 2)->default(0);

            $table->enum('rating', [
                'Excellent',
                'Very Good',
                'Good',
                'Average',
                'Poor'
            ])->default('Average');

            // Manager Review
            $table->text('strengths')->nullable();
            $table->text('weaknesses')->nullable();
            $table->text('remarks')->nullable();
            $table->text('goals')->nullable();
            $table->text('improvement_plan')->nullable();

            // Next Review
            $table->date('next_review_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performances');
    }
};