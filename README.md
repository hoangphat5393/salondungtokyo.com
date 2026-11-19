# Salon Dũng Tokyo (`salondungtokyo.com`)

Hệ thống website thương hiệu **Viện Tạo Mẫu Tóc Cao Cấp & Đào Tạo Nghề Tóc Salon Dũng Tokyo** theo phong cách Nhật Bản, xây dựng trên nền tảng **Laravel (PHP 8.2+)**, **PostgreSQL 16**, **Bootstrap 5 / Vite** và **AdminLTE 4**.

---

## Tính năng chính

### Frontend (Khách hàng)
- **Giao diện Luxury Gold & Obsidian**: Thiết kế hiện đại theo bộ nhận diện Đen huyền bí (`#121316`) & Vàng kim (`#C5A059`).
- **Trang Chủ & Bộ Sưu Tập (Lookbook)**: Hero Banner tích hợp form đặt lịch nhanh, giới thiệu dịch vụ cốt lõi, bảng giá và album mẫu tóc.
- **Dịch Vụ & Bảng Giá**: Danh mục chi tiết các nhóm dịch vụ (Cắt tạo kiểu, Uốn, Nhuộm, Phục hồi, Gội đầu dưỡng sinh, Đào tạo nghề).
- **Tin Tức & Xu Hướng Tóc**: Hệ thống bài viết, chi tiết bài viết, phân loại danh mục và tối ưu SEO.
- **Liên Hệ & Đặt Lịch Hẹn**: Form đặt lịch trực tuyến có xác thực reCAPTCHA v3, thông báo Toast góc phải (SweetAlert2) và trang hoàn tất đặt lịch.

### Backend (Quản trị — AdminLTE 4)
- **Quản lý nội dung (CMS)**: Bài viết, Danh mục, Trang tĩnh, Banner/Slider, Menu đa cấp, Shortcode.
- **Quản lý tương tác**: Yêu cầu liên hệ & đặt lịch hẹn khách hàng.
- **Quản lý media**: Tích hợp CKFinder & Intervention Image xử lý ảnh tự động.
- **Phân quyền & Hệ thống**: Quản lý người dùng, vai trò (Roles/Permissions), cài đặt website, cấu hình ngôn ngữ & đồng bộ cơ sở dữ liệu.
- **Kiến trúc Model tinh gọn**: 22 Eloquent Models chuẩn hóa (13 Backend + 9 Frontend) khớp 1-1 với schema PostgreSQL.

---

## Công nghệ sử dụng

- **Backend**: PHP 8.2+, Laravel Framework, Laravel Sanctum, Laravel Socialite, Intervention Image, CKFinder, Maatwebsite Excel
- **Database**: PostgreSQL 16 (hỗ trợ xuất/đồng bộ MySQL)
- **Frontend**: Blade Templates, Bootstrap 5.3, SCSS, Tailwind CSS, Swiper 11, SweetAlert2, Vite
- **Admin Dashboard**: AdminLTE 4
- **Testing & Code Quality**: PHPUnit / Pest, Laravel Pint

---

## Hướng dẫn cài đặt & chạy dự án

### Yêu cầu môi trường
- PHP >= 8.2 (khuyến nghị PHP 8.3)
- Composer 2.x
- Node.js >= 18.x & pnpm / npm
- PostgreSQL 16 (hoặc MySQL 8)

### Các bước cài đặt

```bash
# 1. Clone repository
git clone https://github.com/hoangphat5393/salondungtokyo.git
cd salondungtokyo

# 2. Cài đặt PHP & Frontend dependencies
composer install
pnpm install   # hoặc: npm install

# 3. Tạo file môi trường và APP_KEY
cp .env.example .env
php artisan key:generate

# 4. Cấu hình thông tin Database trong file .env rồi chạy migrate
php artisan migrate

# 5. Tạo symlink storage (nếu cần)
php artisan storage:link

# 6. Build assets hoặc chạy dev server
pnpm run build   # hoặc: pnpm run dev
php artisan serve
```

### Chạy kiểm thử (Tests)

```bash
php artisan test --compact
```

---

## Giấy phép

Phát hành theo giấy phép [MIT License](LICENSE) © 2026 Hoàng Phát.
