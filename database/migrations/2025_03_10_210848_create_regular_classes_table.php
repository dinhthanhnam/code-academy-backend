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
        Schema::create('regular_classes', function (Blueprint $table) {
            $table->id();
            $table->string('class_code')->unique(); // Ví dụ: CNTT-K45
            $table->string('name'); // Tên lớp, ví dụ: Công nghệ thông tin K45
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regular_classes');
    }
};
