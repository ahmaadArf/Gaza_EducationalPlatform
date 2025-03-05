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
        Schema::create('final_degrees', function (Blueprint $table) {
            $table->id();
            $table->string('subject_id')->constrained('subjects');
            $table->foreignId('student_id')->constrained('students');
            $table->double('mid')->nullable();
            $table->double('final')->nullable();
            $table->foreignId('grade_id')->constrained('grades');
            $table->foreignId('classroom_id')->constrained('classrooms');
            $table->foreignId('section_id')->constrained('sections');
            $table->string('academic_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('final_degrees');
    }
};
