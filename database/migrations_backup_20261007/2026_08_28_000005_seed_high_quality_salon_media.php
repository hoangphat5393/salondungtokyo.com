<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Dọn dẹp và nạp Album Mẫu Tóc Tokyo + Album Items
        DB::table('album_items')->delete();
        DB::table('albums')->delete();

        $albumData = [
            [
                'id' => 1,
                'name' => 'Uốn Sóng Lơi Nữ Thần Tokyo',
                'name_en' => 'Tokyo Goddess Wavy Hair',
                'status' => 1,
                'sort' => 1,
                'admin_id' => 1,
                'image' => 'upload/images/hair_1.jpg',
            ],
            [
                'id' => 2,
                'name' => 'Tóc Layer Nữ Chuẩn Phong Cách Nhật',
                'name_en' => 'Japanese Style Layered Cut',
                'status' => 1,
                'sort' => 2,
                'admin_id' => 1,
                'image' => 'upload/images/hair_2.jpg',
            ],
            [
                'id' => 3,
                'name' => 'Nhuộm Balayage & Highlight Khói Trầm',
                'name_en' => 'Ash Grey Balayage & Highlight',
                'status' => 1,
                'sort' => 3,
                'admin_id' => 1,
                'image' => 'upload/images/hair_3.jpg',
            ],
            [
                'id' => 4,
                'name' => 'Uốn Xoăn Hippie & Tóc Bob Cá Tính',
                'name_en' => 'Hippie Curls & Chic Bob',
                'status' => 1,
                'sort' => 4,
                'admin_id' => 1,
                'image' => 'upload/images/hair_4.jpg',
            ],
            [
                'id' => 5,
                'name' => 'Cắt Bob Tỉa Layer Thời Thượng',
                'name_en' => 'Modern Bob Layer Cut',
                'status' => 1,
                'sort' => 5,
                'admin_id' => 1,
                'image' => 'upload/images/hair_5.jpg',
            ],
            [
                'id' => 6,
                'name' => 'Tạo Kiểu Uốn Side Part / Layer Nam Đẳng Cấp',
                'name_en' => 'Premium Men Texture & Side Part',
                'status' => 1,
                'sort' => 6,
                'admin_id' => 1,
                'image' => 'upload/images/hair_6.jpg',
            ],
        ];

        foreach ($albumData as $item) {
            DB::table('albums')->insert([
                'id' => $item['id'],
                'name' => $item['name'],
                'name_en' => $item['name_en'],
                'status' => $item['status'],
                'sort' => $item['sort'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('album_items')->insert([
                'album_id' => $item['id'],
                'name' => $item['name'],
                'name_en' => $item['name_en'],
                'image' => $item['image'],
                'sort' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 2. Dọn dẹp và nạp Dịch Vụ Salon thực tế
        DB::table('pages')->where('type', 'service')->delete();

        $services = [
            [
                'name' => 'Cắt & Sấy Tạo Kiểu Chuẩn Tỷ Lệ Vàng',
                'slug' => 'cat-say-tao-kieu-chuan-ty-le-vang',
                'type' => 'service',
                'image' => 'upload/images/service_1.jpg',
                'description' => 'Cắt tỉa form tóc cá nhân hóa theo từng dáng khuôn mặt, gội massage bấm huyệt và sấy tạo kiểu bồng bềnh tự nhiên.',
                'content' => '<p>Dịch vụ cắt tóc chuẩn Salon Nhật Bản với quy trình 5 bước: Tư vấn dáng tóc - Gội dưỡng sinh - Cắt tỉa kỹ thuật cao - Xả sạch - Sấy tạo phom bồng bềnh.</p>',
                'status' => 1,
                'sort' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'Uốn Setting Sóng Lơi Organic Nhật Bản',
                'slug' => 'uon-setting-song-loi-organic-nhat-ban',
                'type' => 'service',
                'image' => 'upload/images/service_2.jpg',
                'description' => 'Kỹ thuật uốn setting nhiệt độ thấp kết hợp thuốc uốn hữu cơ giúp giữ nếp sóng lơi tự nhiên, tóc bóng mượt không lo khô xơ.',
                'content' => '<p>Công nghệ uốn sóng lơi độc quyền từ Tokyo mang lại mái tóc xoăn mềm mại như lụa, dễ dàng chăm sóc tại nhà chỉ với thao tác sấy tay đơn giản.</p>',
                'status' => 1,
                'sort' => 2,
                'user_id' => 1,
            ],
            [
                'name' => 'Nhuộm Thời Thượng & Tẩy Tóc Công Nghệ Bảo Vệ',
                'slug' => 'nhuom-thoi-thuong-va-tay-toc-cong-nghe-bao-ve',
                'type' => 'service',
                'image' => 'upload/images/service_3.jpg',
                'description' => 'Bảng màu hot trend đa dạng: Nâu tây, Trà sữa, Khói xám, Balayage. Công nghệ khóa màu hạt nano giúp tóc bóng khỏe dài lâu.',
                'content' => '<p>Nhuộm tóc với dòng sản phẩm cao cấp không mùi hắc, bảo vệ da đầu nhạy cảm và duy trì độ bóng mượt vượt trội.</p>',
                'status' => 1,
                'sort' => 3,
                'user_id' => 1,
            ],
            [
                'name' => 'Combo Phục Hồi Tóc Keratin Chuyên Sâu Tái Sinh',
                'slug' => 'combo-phuc-hoi-toc-keratin-chuyen-sau-tai-sinh',
                'type' => 'service',
                'image' => 'upload/images/service_4.jpg',
                'description' => 'Cứu cánh cho mái tóc hư tổn nặng do uốn nhuộm nhiều lần. Bổ sung Keratin và Protein tái tạo lõi tóc từ sâu bên trong.',
                'content' => '<p>Liệu trình phục hồi 4 bước độc quyền giúp tóc lấy lại độ đàn hồi, hết chẻ ngọn và mềm mượt tức thì ngay sau buổi đầu tiên.</p>',
                'status' => 1,
                'sort' => 4,
                'user_id' => 1,
            ],
        ];

        foreach ($services as $service) {
            DB::table('pages')->insert(array_merge($service, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }

    public function down(): void
    {
        //
    }
};
