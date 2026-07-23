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
        Schema::create('notifications', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title');

            $table->text('message');

            $table->enum('type', [
                'Employee',
                'Leave',
                'Task',
                'Project',
                'Payroll',
                'Performance',
                'Invoice',
                'Event',
                'Announcement'
            ]);

            $table->enum('priority', [
                'Low',
                'Medium',
                'High'
            ])->default('Medium');

            $table->enum('status', [
                'Unread',
                'Read'
            ])->default('Unread');

            $table->string('action_url')->nullable();

            $table->timestamp('read_at')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};