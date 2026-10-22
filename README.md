# Salon Dũng Tokyo

Website viện tạo mẫu tóc & đào tạo nghề tóc chuẩn Tokyo — **Laravel 13 (v13.37.0)**, **PHP 8.3+**, **PostgreSQL 16**, **AdminLTE 4**.

## Chạy nhanh

```bash
composer install
cp .env.example .env   # nếu chưa có
php artisan key:generate
php artisan serve
```

## Kiểm thử

```bash
php artisan test --compact
```

## Stack tóm tắt (Tech Stack)

- **Backend:** Laravel 13 (v13.37.0), PHP 8.3+, Eloquent ORM
- **Database:** PostgreSQL 16 (Port 5432, UTF-8, Sequence ID Management, 11 Foreign Keys)
- **Frontend:** Blade, Bootstrap 5 / Custom CSS, jQuery, Axios, Swiper, FontAwesome Pro
- **Admin:** AdminLTE 4.1, jQuery + Axios, CKFinder
- **Auth:** guard `web` (khách hàng), `admin` (bảng `users`)
- **Quản trị CSDL:** Module Bảo trì CSDL (`/admin/database-maintenance`) - Reset ID về 1 & Đồng bộ ID tiếp theo

## Tài liệu liên quan

- [project_info.md](project_info.md): Thông tin thương hiệu, dịch vụ cốt lõi, bảng màu nhận diện
- [docs/ADVANCED_FEATURES_PLAYBOOK.md](docs/ADVANCED_FEATURES_PLAYBOOK.md): Kế hoạch nâng cấp tính năng nâng cao
