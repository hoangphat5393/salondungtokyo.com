<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Chuyển Menu Dịch Vụ Salon thành menu cấp 1 trực tiếp
        DB::table('admin_menus')->where('id', 1)->update([
            'parent_id' => 0,
            'title' => 'admin.service',
            'uri' => 'admin.service.index',
            'icon' => 'fa fa-scissors',
            'sort' => 3,
        ]);

        // 2. Chuyển Menu Bài Viết thành menu cấp 1 trực tiếp
        DB::table('admin_menus')->where('id', 8)->update([
            'parent_id' => 0,
            'title' => 'admin.post',
            'uri' => 'admin.post.index',
            'icon' => 'fa fa-newspaper',
            'sort' => 5,
        ]);

        // 3. Xóa các menu con chuyên mục và danh sách con của Dịch vụ & Bài viết
        DB::table('admin_menus')->whereIn('id', [2, 3, 9, 10])->delete();
    }

    public function down(): void
    {
        //
    }
};
