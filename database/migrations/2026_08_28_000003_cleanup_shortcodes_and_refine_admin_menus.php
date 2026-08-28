<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Drop bảng shortcodes nếu tồn tại
        Schema::dropIfExists('shortcodes');

        // 2. Tái cấu trúc bảng admin_menus sạch gọn, chỉ giữ module nghiệp vụ chính
        DB::table('admin_menus')->truncate();

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
