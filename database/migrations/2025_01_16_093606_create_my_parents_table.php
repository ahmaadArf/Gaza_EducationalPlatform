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
        Schema::create('my_parents', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');

            //Fatherinformation
            $table->string('name_Father');
            $table->string('national_ID_Father');
            $table->string('passport_ID_Father');
            $table->string('phone_Father');
            $table->string('job_Father');
            $table->foreignId('nationality_Father_id')->constrained('nationalities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('blood_Type_Father_id')->constrained('type_bloods')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('religion_Father_id')->constrained('religions')->onDelete('cascade')->onUpdate('cascade');
            $table->string('address_Father');

            //Mother information
            $table->string('name_Mother');
            $table->string('national_ID_Mother');
            $table->string('passport_ID_Mother');
            $table->string('phone_Mother');
            $table->string('job_Mother');
            $table->foreignId('nationality_Mother_id')->constrained('nationalities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('blood_Type_Mother_id')->constrained('type_bloods')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('religion_Mother_id')->constrained('religions')->onDelete('cascade')->onUpdate('cascade');
            $table->string('address_Mother');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_parents');
    }
};
