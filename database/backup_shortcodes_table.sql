-- Backup of shortcodes table from salondungtokyo_old
CREATE TABLE `shortcodes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `shortcode` varchar(1000) DEFAULT NULL,
  `handle_id` varchar(500) DEFAULT NULL,
  `name` varchar(500) DEFAULT NULL,
  `name_en` varchar(500) DEFAULT NULL,
  `description` text,
  `description_en` text,
  `content` longtext,
  `content_en` longtext,
  `image` varchar(500) DEFAULT NULL,
  `sort` int DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `admin_id` int DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `shortcodes` (`id`, `shortcode`, `handle_id`, `name`, `name_en`, `description`, `description_en`, `content`, `content_en`, `image`, `sort`, `status`, `created_at`, `updated_at`, `admin_id`) VALUES ('2', '[menu_banner slug=\"xxx\"]', 'menu-banner', 'Menu + Banner', 'Menu + Banner', '&lt;p&gt;Hiện&amp;nbsp;menu + banner&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Replace xxx with page slug to get that page image&lt;/strong&gt;&lt;/p&gt;', '<p>show menu + banner</p>\r\n\r\n<p><strong>Thay thế xxx bằng sên trang để lấy hình ảnh trang đó</strong></p>', NULL, NULL, '/upload/images/shortcode/Screenshot%202024-03-19%20105720.png', '2', '1', '2024-01-20 12:24:07', '2024-03-19 11:01:21', '1');
INSERT INTO `shortcodes` (`id`, `shortcode`, `handle_id`, `name`, `name_en`, `description`, `description_en`, `content`, `content_en`, `image`, `sort`, `status`, `created_at`, `updated_at`, `admin_id`) VALUES ('3', '[menu_slider]', 'menu-slider', 'Menu + Slider', 'Menu + Slider', '&lt;p&gt;Show menu + slider&lt;/p&gt;', '<p>Show menu + slider</p>', NULL, NULL, '/upload/images/shortcode/Screenshot%202024-03-19%20105435.png', '1', '1', '2024-04-21 13:04:49', '2024-04-17 22:04:00', '1');
INSERT INTO `shortcodes` (`id`, `shortcode`, `handle_id`, `name`, `name_en`, `description`, `description_en`, `content`, `content_en`, `image`, `sort`, `status`, `created_at`, `updated_at`, `admin_id`) VALUES ('5', '[video_iframe url=\"xxx\"]', 'embed-video-url', 'Nhúng link video', 'Embed video url', '<p>Embed&nbsp;video link</p>\r\n\r\n<p>Replace xxx with&nbsp;video url</p>\r\n\r\n<p><strong>Example:</strong></p>\r\n\r\n<p>[video_iframe url=&quot;https://www.youtube.com/embed/fvkzu1TkobI?si=sARnHRjas0ZXniLc&amp;enablejsapi=1&amp;disablekb=1&amp;controls=1&amp;rel=0&amp;iv_load_policy=3&amp;cc_load_policy=0&amp;modestbranding=1&amp;fs=0&amp;mute=1&amp;autoplay=1&amp;loop=1&quot;]</p>', '<p>Nhúng link link</p>\r\n\r\n<p>Thay xxx thành video url</p>\r\n\r\n<p><strong>Example:</strong></p>\r\n\r\n<p>[video_iframe url=&quot;https://www.youtube.com/embed/fvkzu1TkobI?si=sARnHRjas0ZXniLc&amp;enablejsapi=1&amp;disablekb=1&amp;controls=1&amp;rel=0&amp;iv_load_policy=3&amp;cc_load_policy=0&amp;playsinline=1&amp;showinfo=0&amp;modestbranding=1&amp;fs=0&amp;mute=1&amp;autoplay=1&amp;loop=1&quot;]</p>', NULL, NULL, '/upload/images/shortcode/shortcode6.png', '6', '1', '2024-04-29 10:20:52', '2024-07-02 09:14:50', '1');
INSERT INTO `shortcodes` (`id`, `shortcode`, `handle_id`, `name`, `name_en`, `description`, `description_en`, `content`, `content_en`, `image`, `sort`, `status`, `created_at`, `updated_at`, `admin_id`) VALUES ('6', '[image_list id=\"xxx\" limit=\"yyy\" cols=\"zzz\"]', 'staff-shortcode', 'Danh sách ảnh', 'Image List', '&lt;p&gt;show list image&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Replace xxx with slider id in&amp;nbsp;Image Manage to get list image&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Replace yyyy with the number of photos you would like to retrieve&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Replace zzz with number to change display layout&lt;/strong&gt;&lt;/p&gt;', '<p>hiển thị hình ảnh danh sách</p>\r\n\r\n<p><strong>Thay thế xxx bằng id thanh trượt trong Quản lý hình ảnh để lấy hình ảnh danh sách</strong></p>\r\n\r\n<p><strong>Thay thế yyyy bằng số lượng ảnh muốn lấy</strong></p>\r\n\r\n<p><strong>Thay thế zzz bằng số để thay đổi bố cục hiển thị</strong></p>', NULL, NULL, '/upload/images/shortcode/shortcode5.png', '5', '1', '2024-04-29 13:08:55', '2024-04-29 13:09:05', '1');
