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
        Schema::create('mark_grades', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Grade name, e.g., A+, B
            $table->decimal('point', 4, 2); // GPA or point, e.g., 4.00
            $table->decimal('percent_from', 5, 2); // Start of percentage range
            $table->decimal('percent_upto', 5, 2); // End of percentage range
            $table->text('remarks')->nullable(); // Optional remarks
            $table->unsignedTinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mark_grades');
    }
};
