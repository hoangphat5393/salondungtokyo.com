<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('admin_menus')->truncate();

        $menus = [
            // 1. Dịch Vụ Salon (Cha có con -> uri = null)
            [
                'id' => 1,
                'parent_id' => 0,
                'title' => 'admin.service',
                'icon' => 'fa-solid fa-scissors',
                'uri' => null,
                'sort' => 1,
                'hidden' => 0,
            ],
            [
                'id' => 2,
                'parent_id' => 1,
                'title' => 'admin.service_list',
                'icon' => 'fas fa-angle-right',
                'uri' => 'admin.service.index',
                'sort' => 1,
                'hidden' => 0,
            ],
            [
                'id' => 3,
                'parent_id' => 1,
                'title' => 'admin.category',
                'icon' => 'fas fa-angle-right',
                'uri' => 'admin.service-category.index',
                'sort' => 2,
                'hidden' => 0,
            ],

            // 2. Album Mẫu Tóc (Cha có con -> uri = null)
            [
                'id' => 4,
                'parent_id' => 0,
                'title' => 'admin.album',
                'icon' => 'far fa-images',
                'uri' => null,
                'sort' => 2,
                'hidden' => 0,
            ],
            [
                'id' => 5,
                'parent_id' => 4,
                'title' => 'admin.library',
                'icon' => 'fas fa-angle-right',
                'uri' => 'admin.album.library',
                'sort' => 1,
                'hidden' => 0,
            ],
            [
                'id' => 6,
                'parent_id' => 4,
                'title' => 'admin.album_list',
                'icon' => 'fas fa-angle-right',
                'uri' => 'admin.album.index',
                'sort' => 2,
                'hidden' => 0,
            ],

            // 3. Khách Đặt Lịch & Liên Hệ (Đơn)
            [
                'id' => 7,
                'parent_id' => 0,
                'title' => 'admin.contact',
                'icon' => 'fas fa-phone-volume',
                'uri' => 'admin.contact.index',
                'sort' => 3,
                'hidden' => 0,
            ],

            // 4. Bài Viết & Xu Hướng (Cha có con -> uri = null)
            [
                'id' => 8,
                'parent_id' => 0,
                'title' => 'admin.post',
                'icon' => 'fas fa-newspaper',
                'uri' => null,
                'sort' => 4,
                'hidden' => 0,
            ],
            [
                'id' => 9,
                'parent_id' => 8,
                'title' => 'admin.post_list',
                'icon' => 'fas fa-angle-right',
                'uri' => 'admin.post.index',
                'sort' => 1,
                'hidden' => 0,
            ],
            [
                'id' => 10,
                'parent_id' => 8,
                'title' => 'admin.category',
                'icon' => 'fas fa-angle-right',
                'uri' => 'admin.post-category.index',
                'sort' => 2,
                'hidden' => 0,
            ],

            // 5. Trang Nội Dung (Đơn)
            [
                'id' => 11,
                'parent_id' => 0,
                'title' => 'admin.page',
                'icon' => 'fas fa-file',
                'uri' => 'admin.page.index',
                'sort' => 5,
                'hidden' => 0,
            ],

            // 6. Quản Lý Menu (Đơn)
            [
                'id' => 12,
                'parent_id' => 0,
                'title' => 'admin.menu',
                'icon' => 'fas fa-bars',
                'uri' => 'admin.menu.index',
                'sort' => 6,
                'hidden' => 0,
            ],

            // 7. Mẫu Email (Đơn)
            [
                'id' => 13,
                'parent_id' => 0,
                'title' => 'admin.email_template',
                'icon' => 'far fa-envelope',
                'uri' => 'admin.email-template.index',
                'sort' => 7,
                'hidden' => 0,
            ],
        ];

        foreach ($menus as $item) {
            DB::table('admin_menus')->insert($item);
        }
    }

    public function down(): void
    {
        //
    }
};
