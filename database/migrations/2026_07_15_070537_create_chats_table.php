<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chats', function (Blueprint $table) {

            $table->id();

            $table->foreignId('employee_id')
                ->constrained('employees')
                ->cascadeOnDelete();

            $table->string('subject');

            $table->longText('message');

            $table->enum('status', [
                'Active',
                'Closed'
            ])->default('Active');

            $table->enum('priority', [
                'Low',
                'Medium',
                'High'
            ])->default('Medium');

            $table->enum('chat_type', [
                'Private',
                'Group'
            ])->default('Private');

            $table->string('attachment')->nullable();

            $table->boolean('is_read')->default(false);

            $table->boolean('is_pinned')->default(false);

            $table->boolean('is_starred')->default(false);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};