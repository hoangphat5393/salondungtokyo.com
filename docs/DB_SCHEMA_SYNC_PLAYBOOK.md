# PLAYBOOK ĐỐI CHIẾU & ĐỒNG BỘ SCHEMA DATABASE (`salondungtokyo` ↔ `salondungtokyo_old`)

> **Cập nhật:** 2026-11-19  
> **Mục tiêu:** Chuẩn hóa 100% cấu trúc bảng (Tables) và cột (Columns) của database **`salondungtokyo_old`** (MariaDB/MySQL) khớp tuyệt đối với database chuẩn **`salondungtokyo`** (PostgreSQL 16) — không thừa, không thiếu bất kỳ bảng hoặc cột nào.

---

## 1. Tổng Quan Môi Trường Đối Chiếu

| Tiêu chí | Dự án Mới (`salondungtokyo`) — **Chuẩn tham chiếu** | Dự án Cũ (`salondungtokyo_old`) — **Đã đồng bộ** |
| :--- | :--- | :--- |
| **Thư mục mã nguồn** | `e:\web\salondungtokyo` | `e:\web\salondungtokyo_old` |
| **Hệ quản trị CSDL** | PostgreSQL 16 (`127.0.0.1:5432`) | MariaDB / MySQL (`localhost:3306`) |
| **Tên Database** | `salondungtokyo` | `salondungtokyo_old` |
| **Tổng số bảng trước đồng bộ** | **32 bảng** | 31 bảng *(thiếu 2 bảng, thừa 1 bảng)* |
| **Tổng số bảng sau đồng bộ** | **31 bảng** *(đã gỡ `post_categories`)* | **31 bảng (Khớp 100%)** |
| **Tổng số cột sau đồng bộ** | **276 cột** | **276 cột (Khớp 100% tên & thứ tự cột)** |

---

## 2. Phát Hiện Sai Khác Trước Khi Đồng Bộ (Gap Analysis)

### 2.1. Sai khác về Bảng (Tables)

| # | Tên bảng | Trạng thái ở `salondungtokyo` (Mới) | Trạng thái ở `salondungtokyo_old` (Cũ - Trước xử lý) | Hành động đã thực hiện |
| :- | :--- | :--- | :--- | :--- |
| 1 | `post_categories` | **Có** (`post_id`, `category_id`) | **Thiếu** | Tạo bảng `post_categories` với khóa chính kép `(post_id, category_id)`. |
| 2 | `role_user` | **Có** (`user_id`, `role_id`) | **Thiếu** *(chỉ có `role_users`)* | Tạo bảng `role_user` với khóa chính kép `(user_id, role_id)` và đồng bộ dữ liệu liên kết từ `role_users`. |
| 3 | `shortcodes` | **Đã gỡ bỏ** *(chuyển sang `ShortcodeServiceProvider`)* | **Thừa** (15 cột, 4 dòng) | Sao lưu toàn bộ cấu trúc + dữ liệu ra `database/backup_shortcodes_table.sql`, sau đó `DROP TABLE shortcodes`. |

### 2.2. Sai khác về Cột trong các Bảng chung (Column Gaps)

| # | Tên bảng | Cột bị thiếu ở `salondungtokyo_old` | Kiểu dữ liệu & Vị trí chuẩn | Hành động đã thực hiện |
| :- | :--- | :--- | :--- | :--- |
| 1 | `contacts` | `address` | `VARCHAR(255) NULL` (sau `email`) | `ALTER TABLE contacts ADD COLUMN address VARCHAR(255) NULL AFTER email` |
| 2 | `permissions` | `display_name`<br>`description`<br>`slug`<br>`resource`<br>`action` | `VARCHAR(255) NULL` (nằm giữa `name` và `http_uri`) | Bổ sung đủ 5 cột theo đúng thứ tự của `salondungtokyo` (từ 5 cột lên 10 cột). |
| 3 | `roles` | `name_en`<br>`display_name`<br>`description` | `VARCHAR(255) NULL` (`name_en` sau `name`; `display_name`, `description` sau `slug`) | Bổ sung đủ 3 cột theo đúng thứ tự của `salondungtokyo` (từ 5 cột lên 8 cột). |

---

## 3. Bảng Đối Chiếu Toàn Bộ 32 Bảng & 278 Cột (Trạng Thái Sau Đồng Bộ)

| # | Tên bảng | Số cột (Mới) | Số cột (Cũ) | Danh sách cột (Khớp 100% cả tên và thứ tự) | Kết quả |
| :- | :--- | :---: | :---: | :--- | :---: |
| 1 | `admin_menus` | 11 | 11 | `id`, `parent_id`, `sort`, `title`, `icon`, `uri`, `type`, `hidden`, `key`, `created_at`, `updated_at` | **100% Match** |
| 2 | `album_items` | 20 | 20 | `id`, `album_id`, `sub_name`, `sub_name_en`, `name`, `name_en`, `description`, `description_en`, `image`, `image_en`, `video`, `video_en`, `link`, `link_en`, `link_name`, `link_name_en`, `target`, `sort`, `created_at`, `updated_at` | **100% Match** |
| 3 | `albums` | 7 | 7 | `id`, `name`, `name_en`, `sort`, `status`, `created_at`, `updated_at` | **100% Match** |
| 4 | `cache` | 3 | 3 | `key`, `value`, `expiration` | **100% Match** |
| 5 | `cache_locks` | 3 | 3 | `key`, `owner`, `expiration` | **100% Match** |
| 6 | `categories` | 23 | 23 | `id`, `slug`, `type`, `name`, `name_en`, `description`, `description_en`, `content`, `content_en`, `icon`, `image`, `cover`, `parent`, `hot`, `recommended`, `sort`, `status`, `admin_id`, `seo_title`, `seo_keyword`, `seo_description`, `created_at`, `updated_at` | **100% Match** |
| 7 | `contacts` | 13 | 13 | `id`, `type`, `name`, `email`, `address`, `phone`, `file`, `content`, `sort`, `ip_address`, `status`, `created_at`, `updated_at` | **100% Match** |
| 8 | `country` | 10 | 10 | `id`, `code`, `code_3`, `name`, `phone`, `symbol`, `capital`, `currency`, `continent`, `continent_code` | **100% Match** |
| 9 | `customer` | 19 | 19 | `id`, `username`, `full_name`, `email`, `provider_id`, `provider`, `about_me`, `birthday`, `phone`, `address`, `province`, `district`, `ward`, `avatar`, `password`, `status`, `remember_token`, `created_at`, `updated_at` | **100% Match** |
| 10 | `customer_forget_pass_otp` | 7 | 7 | `id`, `email`, `user_id`, `otp_mail`, `status`, `created_at`, `updated_at` | **100% Match** |
| 11 | `email_templates` | 8 | 8 | `id`, `name`, `group`, `text`, `status`, `sort`, `created_at`, `updated_at` | **100% Match** |
| 12 | `failed_jobs` | 6 | 6 | `id`, `connection`, `queue`, `payload`, `exception`, `failed_at` | **100% Match** |
| 13 | `job_batches` | 10 | 10 | `id`, `name`, `total_jobs`, `pending_jobs`, `failed_jobs`, `failed_job_ids`, `options`, `cancelled_at`, `created_at`, `finished_at` | **100% Match** |
| 14 | `jobs` | 7 | 7 | `available_at`, `attempts`, `payload`, `id`, `queue`, `reserved_at`, `created_at` | **100% Match** |
| 15 | `menu_items` | 15 | 15 | `id`, `menu_id`, `slug`, `label`, `link`, `image`, `content`, `parent`, `sort`, `class`, `depth`, `created_at`, `updated_at`, `rel`, `target` | **100% Match** |
| 16 | `menus` | 4 | 4 | `id`, `name`, `created_at`, `updated_at` | **100% Match** |
| 17 | `migrations` | 3 | 3 | `id`, `migration`, `batch` | **100% Match** |
| 18 | `pages` | 16 | 16 | `id`, `slug`, `name`, `description`, `content`, `icon`, `image`, `seo_title`, `seo_keyword`, `seo_description`, `type`, `sort`, `status`, `created_at`, `updated_at`, `user_id` | **100% Match** |
| 19 | `password_reset_tokens` | 3 | 3 | `email`, `token`, `created_at` | **100% Match** |
| 20 | `password_resets` | 3 | 3 | `email`, `token`, `created_at` | **100% Match** |
| 21 | `permission_role` | 2 | 2 | `permission_id`, `role_id` | **100% Match** |
| 22 | `permissions` | 10 | 10 | `id`, `name`, `display_name`, `description`, `slug`, `resource`, `action`, `http_uri`, `created_at`, `updated_at` | **100% Match** |
| 23 | `post_categories` | 2 | 2 | `post_id`, `category_id` | **100% Match** |
| 24 | `role_permissions` | 3 | 3 | `id`, `role_id`, `permission_id` | **100% Match** |
| 25 | `role_user` | 2 | 2 | `user_id`, `role_id` | **100% Match** |
| 26 | `role_users` | 3 | 3 | `id`, `role_id`, `user_id` | **100% Match** |
| 27 | `roles` | 8 | 8 | `id`, `name`, `name_en`, `slug`, `display_name`, `description`, `created_at`, `updated_at` | **100% Match** |
| 28 | `services` | 21 | 21 | `id`, `slug`, `name`, `name_en`, `description`, `description_en`, `content`, `content_en`, `icon`, `image`, `cover`, `gallery`, `status`, `sort`, `seo_title`, `seo_keyword`, `seo_description`, `gallery_checked`, `created_at`, `updated_at`, `admin_id` | **100% Match** |
| 29 | `sessions` | 6 | 6 | `id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity` | **100% Match** |
| 30 | `settings` | 8 | 8 | `id`, `name`, `content`, `type`, `status`, `sort`, `created_at`, `updated_at` | **100% Match** |
| 31 | `user_password_auto` | 6 | 6 | `id`, `email`, `password`, `status`, `created_at`, `updated_at` | **100% Match** |
| 32 | `users` | 16 | 16 | `id`, `name`, `username`, `password`, `avatar`, `birthday`, `phone`, `email`, `address`, `provider`, `provider_id`, `remember_token`, `admin_level`, `status`, `created_at`, `updated_at` | **100% Match** |
| **TỔNG** | **32 bảng** | **278 cột** | **278 cột** | **Không thừa, không thiếu bất kỳ bảng hay cột nào** | **100% Đồng bộ** |

---

## 4. Migration & File Lưu Trữ Liên Quan

1. **Migration đồng bộ tại `salondungtokyo_old`:**
   - `database/migrations/2026_11_19_085000_sync_schema_with_salondungtokyo_new.php` (Đã thực thi & ghi nhận vào bảng `migrations` batch 13).
2. **Bản sao lưu bảng `shortcodes` cũ (phòng khi cần tra cứu dữ liệu cũ):**
   - `database/backup_shortcodes_table.sql` (trong thư mục `salondungtokyo_old`).
