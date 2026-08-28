<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Dọn dẹp bảng admin_menus
        DB::table('admin_menus')->truncate();

        // 2. Tạo cấu trúc Menu Quản trị chuẩn cho Salon Dũng Tokyo
        $menus = [
            [
                'id' => 1,
                'parent_id' => 0,
                'title' => 'admin.service',
                'icon' => 'fa-solid fa-scissors',
                'uri' => 'admin.service.index',
                'sort' => 1,
                'hidden' => 0,
            ],
            [
                'id' => 2,
                'parent_id' => 1,
                'title' => 'admin.service',
                'icon' => 'fa-solid fa-list',
                'uri' => 'admin.service.index',
                'sort' => 1,
                'hidden' => 0,
            ],
            [
                'id' => 3,
                'parent_id' => 1,
                'title' => 'admin.category',
                'icon' => 'fa-solid fa-folder-tree',
                'uri' => 'admin.service-category.index',
                'sort' => 2,
                'hidden' => 0,
            ],
            [
                'id' => 4,
                'parent_id' => 0,
                'title' => 'admin.album',
                'icon' => 'fa-solid fa-images',
                'uri' => 'admin.album.index',
                'sort' => 2,
                'hidden' => 0,
            ],
            [
                'id' => 5,
                'parent_id' => 4,
                'title' => 'admin.album',
                'icon' => 'fa-solid fa-camera',
                'uri' => 'admin.album.index',
                'sort' => 1,
                'hidden' => 0,
            ],
            [
                'id' => 6,
                'parent_id' => 4,
                'title' => 'admin.album_library',
                'icon' => 'fa-solid fa-photo-film',
                'uri' => 'admin.album.library',
                'sort' => 2,
                'hidden' => 0,
            ],
            [
                'id' => 7,
                'parent_id' => 0,
                'title' => 'admin.contact',
                'icon' => 'fa-solid fa-calendar-check',
                'uri' => 'admin.contact.index',
                'sort' => 3,
                'hidden' => 0,
            ],
            [
                'id' => 8,
                'parent_id' => 0,
                'title' => 'admin.post',
                'icon' => 'fa-solid fa-newspaper',
                'uri' => 'admin.post.index',
                'sort' => 4,
                'hidden' => 0,
            ],
            [
                'id' => 9,
                'parent_id' => 8,
                'title' => 'admin.post',
                'icon' => 'fa-solid fa-pen-to-square',
                'uri' => 'admin.post.index',
                'sort' => 1,
                'hidden' => 0,
            ],
            [
                'id' => 10,
                'parent_id' => 8,
                'title' => 'admin.category',
                'icon' => 'fa-solid fa-tags',
                'uri' => 'admin.post-category.index',
                'sort' => 2,
                'hidden' => 0,
            ],
            [
                'id' => 11,
                'parent_id' => 0,
                'title' => 'admin.page',
                'icon' => 'fa-solid fa-file-lines',
                'uri' => 'admin.page.index',
                'sort' => 5,
                'hidden' => 0,
            ],
            [
                'id' => 12,
                'parent_id' => 0,
                'title' => 'admin.menu',
                'icon' => 'fa-solid fa-bars-staggered',
                'uri' => 'admin.menu.index',
                'sort' => 6,
                'hidden' => 0,
            ],
            [
                'id' => 13,
                'parent_id' => 0,
                'title' => 'admin.email_template',
                'icon' => 'fa-solid fa-envelope',
                'uri' => 'admin.email-template.index',
                'sort' => 7,
                'hidden' => 0,
            ],
            [
                'id' => 14,
                'parent_id' => 0,
                'title' => 'admin.shortcode',
                'icon' => 'fa-solid fa-code',
                'uri' => 'admin.shortcode.index',
                'sort' => 8,
                'hidden' => 0,
            ],
            [
                'id' => 15,
                'parent_id' => 0,
                'title' => 'admin.sidebar_menu',
                'icon' => 'fa-solid fa-sliders',
                'uri' => 'admin.admin-menu.index',
                'sort' => 9,
                'hidden' => 0,
            ],
            [
                'id' => 16,
                'parent_id' => 0,
                'title' => 'admin.setting',
                'icon' => 'fa-solid fa-gear',
                'uri' => 'admin.theme-option',
                'sort' => 10,
                'hidden' => 0,
            ],
            [
                'id' => 17,
                'parent_id' => 16,
                'title' => 'admin.theme_option',
                'icon' => 'fa-solid fa-sliders',
                'uri' => 'admin.theme-option',
                'sort' => 1,
                'hidden' => 0,
            ],
            [
                'id' => 18,
                'parent_id' => 16,
                'title' => 'admin.theme_css',
                'icon' => 'fa-brands fa-css3-alt',
                'uri' => 'admin.css.get',
                'sort' => 2,
                'hidden' => 0,
            ],
        ];

        foreach ($menus as $item) {
            DB::table('admin_menus')->insert($item);
        }
    }

    public function down(): void
    {
        DB::table('admin_menus')->truncate();
    }
};
