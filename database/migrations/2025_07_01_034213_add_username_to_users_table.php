<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Thêm cột 'username' nếu chưa có
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->unique()->nullable()->after('id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Xóa cột 'username' nếu đang tồn tại
            if (Schema::hasColumn('users', 'username')) {
                $table->dropUnique(['username']); // xóa unique trước
                $table->dropColumn('username');
            }
        });
    }
};
