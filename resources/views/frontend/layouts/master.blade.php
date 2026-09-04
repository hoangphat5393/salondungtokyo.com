<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $seo['seo_title'] ?? setting_option('webtitle') ?? 'Salon Dũng Tokyo - Đẳng Cấp Tạo Mẫu Tóc Chuyên Nghiệp' }}</title>
    <meta name="description" content="{{ $seo['seo_description'] ?? setting_option('seo_description') ?? 'Salon Dũng Tokyo - Hệ thống salon tạo mẫu tóc cao cấp, cắt uốn duỗi nhuộm chuyên nghiệp hàng đầu.' }}">
    <meta name="keywords" content="{{ $seo['seo_keyword'] ?? setting_option('seo_keyword') ?? 'salon dung tokyo, mau toc dep, uon toc, nhuom toc' }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $seo['seo_title'] ?? setting_option('webtitle') ?? 'Salon Dũng Tokyo' }}">
    <meta property="og:description" content="{{ $seo['seo_description'] ?? setting_option('seo_description') ?? '' }}">
    <meta property="og:image" content="{{ get_image($seo['seo_image'] ?? setting_option('logo')) }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ get_image(setting_option('favicon_32') ?: setting_option('logo')) }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome_pro/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        :root {
            --salon-gold: #c5a059;
            --salon-gold-hover: #b08d48;
            --salon-gold-light: #f7f1e5;
            --salon-dark: #121316;
            --salon-dark-light: #1f2127;
            --salon-gray: #6c757d;
            --salon-font-heading: 'Playfair Display', serif;
            --salon-font-body: 'Montserrat', sans-serif;
        }

        body {
            font-family: var(--salon-font-body);
            color: #333333;
            background-color: #fdfdfd;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6, .font-heading {
            font-family: var(--salon-font-heading);
        }

        /* Topbar */
        .salon-topbar {
            background-color: var(--salon-dark);
            color: #bbb;
            font-size: 0.85rem;
            padding: 8px 0;
            border-bottom: 1px solid rgba(197, 160, 89, 0.2);
        }

        .salon-topbar a {
            color: #ddd;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .salon-topbar a:hover {
            color: var(--salon-gold);
        }

        /* Header / Navbar */
        .salon-navbar {
            background-color: #ffffff;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            padding: 12px 0;
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .salon-navbar .navbar-brand img {
            max-height: 52px;
            width: auto;
        }

        .salon-navbar .nav-link {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--salon-dark);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 8px 16px !important;
            transition: all 0.25s ease;
        }

        .salon-navbar .nav-link:hover, .salon-navbar .nav-link.active {
            color: var(--salon-gold);
        }

        .btn-gold {
            background: linear-gradient(135deg, #d4af37, #aa820a);
            color: #ffffff;
            font-weight: 600;
            border: none;
            border-radius: 50px;
            padding: 10px 24px;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.35);
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .btn-gold:hover {
            background: linear-gradient(135deg, #aa820a, #8c6a04);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.45);
        }

        .btn-outline-gold {
            border: 2px solid var(--salon-gold);
            color: var(--salon-gold);
            font-weight: 600;
            border-radius: 50px;
            padding: 8px 22px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .btn-outline-gold:hover {
            background-color: var(--salon-gold);
            color: #ffffff;
        }

        /* Perfect Circular Icon */
        .salon-icon-circle {
            width: 46px;
            height: 46px;
            min-width: 46px;
            min-height: 46px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50% !important;
            background-color: var(--salon-gold, #c5a059);
            color: #121316;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(197, 160, 89, 0.3);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .salon-icon-circle:hover {
            transform: scale(1.08);
            box-shadow: 0 6px 18px rgba(197, 160, 89, 0.45);
        }

        /* Footer */
        .salon-footer {
            background-color: var(--salon-dark);
            color: #a0a5b1;
            padding: 70px 0 30px;
            position: relative;
            border-top: 3px solid var(--salon-gold);
        }

        .salon-footer h5 {
            color: #ffffff;
            font-size: 1.25rem;
            margin-bottom: 24px;
            position: relative;
            padding-bottom: 12px;
        }

        .salon-footer h5::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background-color: var(--salon-gold);
        }

        .salon-footer a {
            color: #a0a5b1;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .salon-footer a:hover {
            color: var(--salon-gold);
            padding-left: 5px;
        }

        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255,255,255,0.08);
            color: #ffffff;
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            background-color: var(--salon-gold);
            color: #ffffff;
            transform: translateY(-3px);
            padding-left: 0;
        }

        /* Floating CTA Mobile */
        .floating-cta {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .floating-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            text-decoration: none;
            font-size: 1.3rem;
            transition: transform 0.3s ease;
        }

        .floating-btn:hover {
            transform: scale(1.1);
            color: #fff;
        }

        .floating-phone { background-color: #28a745; }
        .floating-zalo { background-color: #0068ff; }
        .floating-booking { background-color: var(--salon-gold); }

        @media (max-width: 768px) {
            .salon-topbar { display: none; }
        }
    </style>

    @stack('styles')
    @stack('head-script')
</head>
<body>

    <!-- Topbar -->
    <div class="salon-topbar">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <span><i class="bi bi-geo-alt text-warning me-1"></i> {{ setting_option('address') ?: 'Hồ Chí Minh, Việt Nam' }}</span>
                <span><i class="bi bi-clock text-warning me-1"></i> Mở cửa: {{ setting_option('opening_hours') ?: '08:30 - 20:30 Hàng ngày' }}</span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="tel:{{ setting_phone(setting_option('hotline')) }}"><i class="bi bi-telephone text-warning me-1"></i> Hotline: {{ setting_option('hotline') ?: '0909 000 000' }}</a>
                <a href="{{ route('admin.dashboard') }}" class="badge bg-secondary text-white text-decoration-none">Admin Login</a>
            </div>
        </div>
    </div>

    <!-- Header Navbar -->
    <nav class="navbar navbar-expand-lg salon-navbar">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('index') }}">
                @if(setting_option('logo'))
                    <img src="{{ get_image(setting_option('logo')) }}" alt="Salon Dũng Tokyo">
                @else
                    <span class="fs-4 fw-bold text-dark font-heading"><i class="bi bi-scissors text-warning me-1"></i> DŨNG TOKYO <span class="text-warning">SALON</span></span>
                @endif
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#salonNav">
                <i class="bi bi-list fs-2 text-dark"></i>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="salonNav">
                <ul class="navbar-nav align-items-lg-center gap-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}" href="{{ route('index') }}">Trang Chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('*service*') ? 'active' : '' }}" href="{{ route('service') }}">Dịch Vụ & Bảng Giá</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index') }}#lookbook">Mẫu Tóc Đẹp</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('*news*') ? 'active' : '' }}" href="{{ route('news') }}">Xu Hướng & Tin Tức</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('*contact*') ? 'active' : '' }}" href="{{ route('contact.index') }}">Liên Hệ</a>
                    </li>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <a href="{{ route('index') }}#booking-section" class="btn btn-gold w-100">
                            <i class="bi bi-calendar-check me-1"></i> Đặt Lịch Ngay
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="salon-footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-white font-heading fw-bold mb-3">SALON DŨNG TOKYO</h4>
                    <p class="text-light-50 mb-3">
                        Hệ thống Salon làm tóc chuẩn phong cách Nhật Bản & Hàn Quốc. Nơi nâng tầm vẻ đẹp mái tóc của bạn với đội ngũ Stylist chuyên môn cao và công nghệ phục hồi tóc độc quyền.
                    </p>
                    <div class="social-icons mt-3">
                        <a href="{{ setting_option('facebook') ?: '#' }}" target="_blank"><i class="bi bi-facebook"></i></a>
                        <a href="{{ setting_option('tiktok') ?: '#' }}" target="_blank"><i class="bi bi-tiktok"></i></a>
                        <a href="{{ setting_option('youtube') ?: '#' }}" target="_blank"><i class="bi bi-youtube"></i></a>
                        <a href="{{ setting_option('instagram') ?: '#' }}" target="_blank"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h5>Dịch Vụ Chính</h5>
                    <ul class="list-unstyled d-flex flex-column gap-2">
                        <li><a href="{{ route('service') }}"><i class="bi bi-chevron-right me-1 small"></i> Cắt Tạo Kiểu Tóc</a></li>
                        <li><a href="{{ route('service') }}"><i class="bi bi-chevron-right me-1 small"></i> Uốn Sóng Organic</a></li>
                        <li><a href="{{ route('service') }}"><i class="bi bi-chevron-right me-1 small"></i> Nhuộm Màu Thời Thượng</a></li>
                        <li><a href="{{ route('service') }}"><i class="bi bi-chevron-right me-1 small"></i> Duỗi Hơi Nước Nano</a></li>
                        <li><a href="{{ route('service') }}"><i class="bi bi-chevron-right me-1 small"></i> Phục Hồi Chuyên Sâu</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5>Hệ Thống Salon</h5>
                    <ul class="list-unstyled d-flex flex-column gap-2">
                        <li><i class="bi bi-geo-alt-fill text-warning me-2"></i> {{ setting_option('address') ?: 'Số 123 Đường Thời Trang, Quận 1, TP. HCM' }}</li>
                        <li><i class="bi bi-telephone-fill text-warning me-2"></i> Hotline: <a href="tel:{{ setting_phone(setting_option('hotline')) }}">{{ setting_option('hotline') ?: '0909 000 000' }}</a></li>
                        <li><i class="bi bi-envelope-fill text-warning me-2"></i> Email: {{ setting_option('email_admin') ?: 'contact@salondungtokyo.vn' }}</li>
                        <li><i class="bi bi-clock-fill text-warning me-2"></i> Giờ làm việc: 08:30 - 20:30</li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5>Đăng Ký Nhận Ưu Đãi</h5>
                    <p class="small text-light-50">Nhập số điện thoại để nhận voucher giảm 20% cho lần làm tóc đầu tiên!</p>
                    <form action="{{ route('contact.submit') }}" method="POST" class="ajax-contact-form">
                        @csrf
                        <input type="hidden" name="contact[name]" value="Khách nhận ưu đãi">
                        <input type="hidden" name="contact[content]" value="Đăng ký nhận mã voucher ưu đãi làm tóc 20%">
                        <div class="input-group">
                            <input type="tel" name="contact[phone]" class="form-control" placeholder="Số điện thoại của bạn..." required>
                            <button class="btn btn-gold" type="submit"><i class="bi bi-send-fill"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            <hr class="border-secondary my-4">

            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0 small">&copy; {{ date('Y') }} Salon Dũng Tokyo. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
                    <small class="text-light-50">Đẳng Cấp Làm Đẹp - Nâng Tầm Phong Cách</small>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating CTA Buttons -->
    <div class="floating-cta">
        <a href="https://zalo.me/{{ setting_phone(setting_option('zalo') ?: setting_option('hotline')) }}" target="_blank" class="floating-btn floating-zalo" title="Chat Zalo">
            <i class="bi bi-chat-dots-fill"></i>
        </a>
        <a href="tel:{{ setting_phone(setting_option('hotline')) }}" class="floating-btn floating-phone" title="Gọi Hotline">
            <i class="bi bi-telephone-fill"></i>
        </a>
        <a href="{{ route('index') }}#booking-section" class="floating-btn floating-booking" title="Đặt Lịch Nhanh">
            <i class="bi bi-calendar-check-fill"></i>
        </a>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Xử lý chung cho các form liên hệ có class .ajax-contact-form nếu chưa được xử lý riêng
            document.querySelectorAll('.ajax-contact-form').forEach(function(form) {
                // Auto clear on typing
                form.querySelectorAll('input, select, textarea').forEach(function(input) {
                    input.addEventListener('input', function() {
                        clearError(this);
                    });
                    input.addEventListener('change', function() {
                        clearError(this);
                    });
                });

                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Xóa lỗi cũ
                    form.querySelectorAll('.error-feedback').forEach(el => el.remove());
                    form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                    form.querySelectorAll('.is-invalid-group').forEach(el => el.classList.remove('is-invalid-group'));

                    let isValid = true;
                    const nameInput = form.querySelector('[name="contact[name]"], [name="name"]');
                    const phoneInput = form.querySelector('[name="contact[phone]"], [name="phone"]');

                    if (nameInput && !nameInput.value.trim()) {
                        showError(nameInput, 'Vui lòng nhập họ và tên!');
                        isValid = false;
                    }

                    if (phoneInput) {
                        const phoneVal = phoneInput.value.trim();
                        if (!phoneVal) {
                            showError(phoneInput, 'Vui lòng nhập số điện thoại!');
                            isValid = false;
                        } else if (phoneVal.length < 9) {
                            showError(phoneInput, 'Số điện thoại tối thiểu 9 số!');
                            isValid = false;
                        }
                    }

                    if (!isValid) return;

                    const submitBtn = form.querySelector('button[type="submit"]');
                    const originalBtnHtml = submitBtn ? submitBtn.innerHTML : '';
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Đang gửi...';
                    }

                    const formData = new FormData(form);

                    fetch(form.getAttribute('action') || "{{ route('contact.submit') }}", {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.json().then(data => ({ status: res.status, body: data })))
                    .then(({ status, body }) => {
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalBtnHtml;
                        }

                        if (status >= 200 && status < 300 && body.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thành Công!',
                                text: body.message || 'Yêu cầu của bạn đã được gửi thành công. Chúng tôi sẽ phản hồi sớm nhất!',
                                confirmButtonColor: '#c5a059'
                            });
                            form.reset();
                        } else {
                            if (body.errors) {
                                for (let key in body.errors) {
                                    const fieldName = key.replace('contact.', '');
                                    const targetInput = form.querySelector(`[name="contact[${fieldName}]"], [name="${fieldName}"]`);
                                    if (targetInput) {
                                        showError(targetInput, body.errors[key][0]);
                                    }
                                }
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Thông báo',
                                    text: body.message || 'Đã có lỗi xảy ra, vui lòng thử lại!',
                                    confirmButtonColor: '#c5a059'
                                });
                            }
                        }
                    })
                    .catch(err => {
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalBtnHtml;
                        }
                        alert('Lỗi kết nối máy chủ, vui lòng thử lại!');
                    });
                });
            });

            function showError(inputEl, msg) {
                inputEl.classList.add('is-invalid');
                const inputGroup = inputEl.closest('.input-group');
                if (inputGroup) {
                    inputGroup.classList.add('is-invalid-group');
                }

                const parentContainer = inputEl.closest('.mb-3, .col-md-6, .col-6, .col-12') || inputEl.parentNode;
                const oldErr = parentContainer.querySelector('.error-feedback');
                if (oldErr) oldErr.remove();

                const errDiv = document.createElement('div');
                errDiv.className = 'error-feedback';
                errDiv.innerHTML = `<i class="bi bi-exclamation-circle-fill"></i><span>${msg}</span>`;

                if (inputGroup) {
                    inputGroup.insertAdjacentElement('afterend', errDiv);
                } else {
                    inputEl.insertAdjacentElement('afterend', errDiv);
                }
            }

            function clearError(inputEl) {
                inputEl.classList.remove('is-invalid');
                const inputGroup = inputEl.closest('.input-group');
                if (inputGroup) {
                    inputGroup.classList.remove('is-invalid-group');
                }
                const parentContainer = inputEl.closest('.mb-3, .col-md-6, .col-6, .col-12') || inputEl.parentNode;
                const err = parentContainer.querySelector('.error-feedback');
                if (err) err.remove();
            }
        });
    </script>

    @stack('scripts')
</body>
</html>

