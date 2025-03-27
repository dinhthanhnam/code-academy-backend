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
        Schema::create('course_classes', function (Blueprint $table) {
            $table->id();
            $table->string('assigned_regular_class_id')->nullable();
            $table->string('course_class_code')->unique(); // Ví dụ: CS101
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('active')->default(true);
            $table->dateTime('start_date')->nullable();
            $table->integer('course_id');
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
