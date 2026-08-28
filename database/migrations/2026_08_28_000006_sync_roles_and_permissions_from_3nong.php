<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Chuẩn hóa schema bảng `roles`
        Schema::table('roles', function (Blueprint $table) {
            if (! Schema::hasColumn('roles', 'display_name')) {
                $table->string('display_name', 255)->nullable()->after('slug');
            }
            if (! Schema::hasColumn('roles', 'description')) {
                $table->string('description', 255)->nullable()->after('display_name');
            }
            if (! Schema::hasColumn('roles', 'name_en')) {
                $table->string('name_en', 255)->nullable()->after('name');
            }
        });

        // 2. Chuẩn hóa schema bảng `permissions`
        Schema::table('permissions', function (Blueprint $table) {
            if (! Schema::hasColumn('permissions', 'display_name')) {
                $table->string('display_name', 255)->nullable()->after('name');
            }
            if (! Schema::hasColumn('permissions', 'description')) {
                $table->string('description', 255)->nullable()->after('display_name');
            }
            if (! Schema::hasColumn('permissions', 'slug')) {
                $table->string('slug', 255)->nullable()->after('description');
            }
            if (! Schema::hasColumn('permissions', 'resource')) {
                $table->string('resource', 255)->nullable()->after('slug');
            }
            if (! Schema::hasColumn('permissions', 'action')) {
                $table->string('action', 255)->nullable()->after('resource');
            }
            if (! Schema::hasColumn('permissions', 'http_uri')) {
                $table->text('http_uri')->nullable()->after('action');
            }
        });

        // 3. Đảm bảo tồn tại cả hai bảng pivot: `role_user` và `role_users`
        if (! Schema::hasTable('role_user')) {
            Schema::create('role_user', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('role_id');
                $table->primary(['user_id', 'role_id']);
            });
        }

        if (! Schema::hasTable('role_users')) {
            Schema::create('role_users', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('role_id');
                $table->primary(['user_id', 'role_id']);
            });
        }

        // 4. Đảm bảo tồn tại cả hai bảng pivot: `permission_role` và `role_permissions`
        if (! Schema::hasTable('permission_role')) {
            Schema::create('permission_role', function (Blueprint $table) {
                $table->unsignedBigInteger('permission_id');
                $table->unsignedBigInteger('role_id');
                $table->primary(['permission_id', 'role_id']);
            });
        }

        if (! Schema::hasTable('role_permissions')) {
            Schema::create('role_permissions', function (Blueprint $table) {
                $table->unsignedBigInteger('role_id');
                $table->unsignedBigInteger('permission_id');
                $table->primary(['role_id', 'permission_id']);
            });
        }

        // 5. Đồng bộ dữ liệu Permissions chuẩn từ 3nong
        DB::table('permission_role')->delete();
        DB::table('role_permissions')->delete();
        DB::table('permissions')->delete();

        $permissions = [
            [
                'id' => 1,
                'name' => 'role-create',
                'display_name' => 'Create Role',
                'description' => 'Create New Role',
                'slug' => 'role-create',
                'resource' => 'role',
                'action' => 'create',
                'http_uri' => 'ANY::admin/role/create,POST::admin/role',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'role-list',
                'display_name' => 'Display Role Listing',
                'description' => 'List All Roles',
                'slug' => 'role-list',
                'resource' => 'role',
                'action' => 'list',
                'http_uri' => 'GET::admin/role',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'role-update',
                'display_name' => 'Update Role',
                'description' => 'Update Role Information',
                'slug' => 'role-update',
                'resource' => 'role',
                'action' => 'update',
                'http_uri' => 'GET::admin/role/*/edit,PUT::admin/role/*',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'role-delete',
                'display_name' => 'Delete Role',
                'description' => 'Delete Role',
                'slug' => 'role-delete',
                'resource' => 'role',
                'action' => 'delete',
                'http_uri' => 'DELETE::admin/role/*',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'user-create',
                'display_name' => 'Create User',
                'description' => 'Create New User',
                'slug' => 'user-create',
                'resource' => 'user',
                'action' => 'create',
                'http_uri' => 'ANY::admin/user/create,POST::admin/user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'user-list',
                'display_name' => 'Display User Listing',
                'description' => 'List All Users',
                'slug' => 'user-list',
                'resource' => 'user',
                'action' => 'list',
                'http_uri' => 'GET::admin/user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'name' => 'user-update',
                'display_name' => 'Update User',
                'description' => 'Update User Information',
                'slug' => 'user-update',
                'resource' => 'user',
                'action' => 'update',
                'http_uri' => 'GET::admin/user/*/edit,PUT::admin/user/*',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'name' => 'user-delete',
                'display_name' => 'Delete User',
                'description' => 'Delete User',
                'slug' => 'user-delete',
                'resource' => 'user',
                'action' => 'delete',
                'http_uri' => 'DELETE::admin/user/*',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($permissions as $p) {
            DB::table('permissions')->insert($p);
        }

        // 6. Đồng bộ dữ liệu Roles chuẩn từ 3nong
        DB::table('role_user')->delete();
        DB::table('role_users')->delete();
        DB::table('roles')->delete();

        $roles = [
            [
                'id' => 9,
                'name' => 'admin',
                'name_en' => 'Admin',
                'slug' => 'admin',
                'display_name' => 'Quản Trị',
                'description' => 'Full Permission',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'name' => 'user',
                'name_en' => 'Member',
                'slug' => 'user',
                'display_name' => 'Thành Viên',
                'description' => 'Thành Viên',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 11,
                'name' => 'Administrator',
                'name_en' => 'Super Administrator',
                'slug' => 'administrator',
                'display_name' => 'Toàn Quyền Hệ Thống',
                'description' => 'System Administrator with full access',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($roles as $r) {
            DB::table('roles')->insert($r);
        }

        // 7. Gán toàn bộ Permissions (1-8) cho Role ID 9 ('admin') và Role ID 11 ('Administrator')
        foreach ([9, 11] as $roleId) {
            for ($permId = 1; $permId <= 8; $permId++) {
                DB::table('permission_role')->insert([
                    'permission_id' => $permId,
                    'role_id' => $roleId,
                ]);

                DB::table('role_permissions')->insert([
                    'role_id' => $roleId,
                    'permission_id' => $permId,
                ]);
            }
        }

        // 8. Gán Role Administrator (11) và Admin (9) cho User Admin ID = 1
        $adminUser = DB::table('users')->where('id', 1)->first();
        if ($adminUser) {
            DB::table('role_user')->insert([
                ['user_id' => 1, 'role_id' => 9],
                ['user_id' => 1, 'role_id' => 11],
            ]);

            DB::table('role_users')->insert([
                ['user_id' => 1, 'role_id' => 9],
                ['user_id' => 1, 'role_id' => 11],
            ]);
        }
    }

    public function down(): void
    {
        //
    }
};
