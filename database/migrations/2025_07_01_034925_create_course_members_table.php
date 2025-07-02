<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id'); // Chỉ giữ cột này
            $table->unsignedBigInteger('course_id');
            $table->enum('role', ['student', 'teacher'])->default('student');
            $table->enum('status', ['pending', 'approved'])->default('pending');
            $table->timestamp('joined_at')->nullable();
            $table->timestamps();

            // Ràng buộc khóa ngoại
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

            // Tránh trùng bản ghi
            $table->unique(['student_id', 'course_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_members');
    }
};
