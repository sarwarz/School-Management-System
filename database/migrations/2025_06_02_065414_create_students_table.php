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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->unique();
            $table->string('roll_no');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->enum('religion', ['Islam', 'Hindu', 'Other']);
            $table->date('date_of_birth');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('class_id');
            $table->string('image')->nullable(); // Path to image
            $table->unsignedTinyInteger('status');
            $table->unique(['class_id', 'roll_no']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
