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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth_date');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('password_confirmation');
            $table->string('phone_number');
            $table->string('current_location');
            $table->date('programming_age');

            $table->string('gender');
            $table->text('bio')->nullable();
            $table->string('image_name')->nullable();
            $table->string('country')->nullable();



            $table->foreignId('student_id')
            ->nullable()->unique()
            ->constrained('students')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();


            $table->foreignId('expert_id')
            ->nullable()->unique()
            ->constrained('experts')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
 

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
