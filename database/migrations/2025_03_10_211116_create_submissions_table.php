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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('problem_id')->constrained('problems')->onDelete('cascade');
            $table->text('source_code'); // Mã nguồn sinh viên nộp
            $table->string('language'); // Ngôn ngữ lập trình (ví dụ: python, java)
            $table->string('status')->default('pending'); // Trạng thái: pending, accepted, wrong_answer, time_limit_exceeded, etc.
            $table->float('execution_time')->nullable(); // Thời gian thực thi (giây)
            $table->integer('memory_used')->nullable(); // Bộ nhớ sử dụng (KB)
            $table->text('output')->nullable(); // Kết quả đầu ra từ Judge0
            $table->string('judge0_token')->nullable(); // Token từ Judge0 API
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
