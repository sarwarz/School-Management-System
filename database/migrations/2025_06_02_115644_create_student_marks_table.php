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
        Schema::create('student_marks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');      // The student who got the mark
            $table->unsignedBigInteger('class_id');        // Class for which the mark is given
            $table->unsignedBigInteger('subject_id');      // Subject of the mark
            $table->unsignedBigInteger('exam_type_id');    // Exam type (Midterm, Final, etc.)
            $table->unsignedSmallInteger('mark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_marks');
    }
};
