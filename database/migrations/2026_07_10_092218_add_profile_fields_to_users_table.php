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
        Schema::table('users', function (Blueprint $table) {

            $table->string('phone')->nullable()->after('email');

            $table->string('designation')->nullable()->after('phone');

            $table->string('department')->nullable()->after('designation');

            $table->date('dob')->nullable()->after('department');

            $table->enum('gender', [
                'Male',
                'Female',
                'Other'
            ])->nullable()->after('dob');

            $table->text('address')->nullable()->after('gender');

            $table->text('bio')->nullable()->after('address');

            $table->string('profile_photo')->nullable()->after('bio');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'phone',
                'designation',
                'department',
                'dob',
                'gender',
                'address',
                'bio',
                'profile_photo'
            ]);

        });
    }
};