<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            if (!Schema::hasColumn('courses', 'teacher_id')) {
                $table->unsignedBigInteger('teacher_id')->nullable()->after('id');

                // Khóa ngoại tới bảng users
                $table->foreign('teacher_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            if (Schema::hasColumn('courses', 'teacher_id')) {
                $table->dropForeign(['teacher_id']);
                $table->dropColumn('teacher_id');
            }
        });
    }
};
