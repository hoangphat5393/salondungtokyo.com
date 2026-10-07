<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Cho phép nullable trên các cột liên kết nếu cần
        if (Schema::hasColumn('pages', 'user_id')) {
            DB::statement('ALTER TABLE pages ALTER COLUMN user_id DROP NOT NULL');
        }

        // 2. Đồng bộ kiểu cột (Type cast sang bigint để khớp khóa chính id)
        if (Schema::hasTable('permission_role')) {
            DB::statement('ALTER TABLE permission_role ALTER COLUMN permission_id TYPE bigint');
            DB::statement('ALTER TABLE permission_role ALTER COLUMN role_id TYPE bigint');
        }

        // 3. Thêm các ràng buộc khóa ngoại (Foreign Keys)
        if (Schema::hasTable('album_items') && Schema::hasTable('albums')) {
            Schema::table('album_items', function (Blueprint $table) {
                $table->foreign('album_id')->references('id')->on('albums')->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('menu_items') && Schema::hasTable('menus')) {
            Schema::table('menu_items', function (Blueprint $table) {
                $table->foreign('menu_id')->references('id')->on('menus')->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('role_user') && Schema::hasTable('users') && Schema::hasTable('roles')) {
            Schema::table('role_user', function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
                $table->foreign('role_id')->references('id')->on('roles')->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('role_users') && Schema::hasTable('users') && Schema::hasTable('roles')) {
            Schema::table('role_users', function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
                $table->foreign('role_id')->references('id')->on('roles')->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('permission_role') && Schema::hasTable('permissions') && Schema::hasTable('roles')) {
            Schema::table('permission_role', function (Blueprint $table) {
                $table->foreign('permission_id')->references('id')->on('permissions')->cascadeOnDelete();
                $table->foreign('role_id')->references('id')->on('roles')->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('role_permissions') && Schema::hasTable('permissions') && Schema::hasTable('roles')) {
            Schema::table('role_permissions', function (Blueprint $table) {
                $table->foreign('permission_id')->references('id')->on('permissions')->cascadeOnDelete();
                $table->foreign('role_id')->references('id')->on('roles')->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('pages') && Schema::hasTable('users')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('pages')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }

        if (Schema::hasTable('role_permissions')) {
            Schema::table('role_permissions', function (Blueprint $table) {
                $table->dropForeign(['permission_id']);
                $table->dropForeign(['role_id']);
            });
        }

        if (Schema::hasTable('permission_role')) {
            Schema::table('permission_role', function (Blueprint $table) {
                $table->dropForeign(['permission_id']);
                $table->dropForeign(['role_id']);
            });
        }

        if (Schema::hasTable('role_users')) {
            Schema::table('role_users', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropForeign(['role_id']);
            });
        }

        if (Schema::hasTable('role_user')) {
            Schema::table('role_user', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropForeign(['role_id']);
            });
        }

        if (Schema::hasTable('menu_items')) {
            Schema::table('menu_items', function (Blueprint $table) {
                $table->dropForeign(['menu_id']);
            });
        }

        if (Schema::hasTable('album_items')) {
            Schema::table('album_items', function (Blueprint $table) {
                $table->dropForeign(['album_id']);
            });
        }
    }
};
