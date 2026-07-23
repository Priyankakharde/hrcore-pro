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
        Schema::create('projects', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | BASIC PROJECT INFO
            |--------------------------------------------------------------------------
            */

            $table->string('project_name');

            $table->string('project_code')->unique();

            $table->string('client_name');

            $table->string('project_manager');

            $table->text('team_members')->nullable();

            /*
            |--------------------------------------------------------------------------
            | PROJECT DETAILS
            |--------------------------------------------------------------------------
            */

            $table->date('start_date');

            $table->date('deadline');

            $table->date('completed_date')->nullable();

            $table->decimal('budget', 12, 2)->default(0);

            $table->decimal('spent_amount', 12, 2)->default(0);

            /*
            |--------------------------------------------------------------------------
            | PROJECT STATUS
            |--------------------------------------------------------------------------
            */

            $table->enum('priority', [
                'Low',
                'Medium',
                'High',
                'Critical'
            ])->default('Medium');

            $table->enum('status', [
                'Pending',
                'Active',
                'On Hold',
                'Completed',
                'Cancelled'
            ])->default('Pending');

            /*
            |--------------------------------------------------------------------------
            | PROGRESS TRACKING
            |--------------------------------------------------------------------------
            */

            $table->integer('progress')->default(0);

            /*
            |--------------------------------------------------------------------------
            | PROJECT EXTRA FEATURES
            |--------------------------------------------------------------------------
            */

            $table->string('department')->nullable();

            $table->string('technology')->nullable();

            $table->string('project_type')->nullable();

            $table->integer('total_tasks')->default(0);

            $table->integer('completed_tasks')->default(0);

            $table->integer('team_size')->default(0);

            /*
            |--------------------------------------------------------------------------
            | DESCRIPTION
            |--------------------------------------------------------------------------
            */

            $table->longText('description')->nullable();

            /*
            |--------------------------------------------------------------------------
            | ATTACHMENTS
            |--------------------------------------------------------------------------
            */

            $table->string('attachment')->nullable();

            /*
            |--------------------------------------------------------------------------
            | TIMESTAMPS
            |--------------------------------------------------------------------------
            */

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};