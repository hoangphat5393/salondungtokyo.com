@extends('frontend.layouts.master')

@section('content')
    <!-- Hero Banner Section -->
    <section class="salon-hero position-relative text-white d-flex align-items-center py-5"
        style="background: linear-gradient(rgba(18, 19, 22, 0.78), rgba(18, 19, 22, 0.78)), url('{{ asset('upload/images/banner_hero.jpg') }}') center/cover no-repeat; min-height: 88vh;">
        <div class="container py-lg-4 my-auto">
            <div class="row align-items-center justify-content-between g-4">
                <div class="col-lg-7 text-center text-lg-start my-auto">
                    <span
                        class="badge bg-warning text-dark px-3 py-2 text-uppercase fw-bold mb-3 letter-spacing-1 d-inline-block">
                        <i class="bi bi-stars"></i> Đẳng Cấp Tạo Mẫu Tóc Tokyo
                    </span>
                    <h1 class="display-3 fw-bold font-heading mb-3 text-white">
                        NÂNG TẦM VẺ ĐẸP <br>
                        <span class="text-warning">MÁI TÓC CỦA BẠN</span>
                    </h1>
                    <p class="lead text-light mb-4" style="max-width: 600px;">
                        Trải nghiệm kỹ thuật cắt tỉa & uốn nhuộm theo công nghệ độc quyền Nhật Bản. Chăm sóc tóc chuẩn Salon
                        quốc tế với các dòng mỹ phẩm hữu cơ cao cấp.
                    </p>
                    <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start align-items-center">
                        <a href="#booking-section" class="btn btn-gold btn-lg px-4">
                            <i class="bi bi-calendar-check me-2"></i> Đặt Lịch Hẹn Ngay
                        </a>
                        <a href="{{ route('service') }}" class="btn btn-outline-light btn-lg px-4">
                            <i class="bi bi-scissors me-2"></i> Xem Bảng Giá Dịch Vụ
                        </a>
                    </div>
                </div>

                <!-- Quick Booking Card on Hero -->
                <div class="col-lg-5 my-auto">
                    <div class="card border-0 shadow-lg p-4 rounded-4"
                        style="background: rgba(255, 255, 255, 0.96); backdrop-filter: blur(10px);">
                        <div class="card-body p-0">
                            <h4 class="card-title font-heading fw-bold text-dark mb-1 text-center">ĐẶT LỊCH LÀM TÓC NHANH
                            </h4>
                            <p class="text-muted small text-center mb-3">Nhận ngay ưu đãi 20% khi đặt trước</p>

                            <form action="{{ route('contact.submit') }}" method="POST" class="ajax-booking-form"
                                novalidate>
                                @csrf
                                <input type="hidden" name="contact[type]" value="booking">

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-dark">Họ và tên của bạn <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i
                                                class="bi bi-person text-warning"></i></span>
                                        <input type="text" name="contact[name]" class="form-control field-name"
                                            placeholder="Ví dụ: Nguyễn Thùy Trang" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-dark">Số điện thoại <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i
                                                class="bi bi-telephone text-warning"></i></span>
                                        <input type="tel" name="contact[phone]" class="form-control field-phone"
                                            placeholder="Ví dụ: 0909 123 456" required>
                                    </div>
                                </div>

                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <label class="form-label small fw-bold text-dark">Ngày hẹn <span
                                                class="text-danger">*</span></label>
                                        <input type="date" name="contact[date]" class="form-control field-date"
                                            value="{{ date('Y-m-d') }}" required>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label small fw-bold text-dark">Dịch vụ quan tâm</label>
                                        <select name="contact[content]" class="form-select field-content">
                                            <option value="Uốn sóng lơi / Uốn phục hồi">Uốn sóng lơi</option>
                                            <option value="Nhuộm màu thời trang / Tẩy tóc">Nhuộm thời trang</option>
                                            <option value="Cắt tạo kiểu Layer / Bob">Cắt tạo kiểu</option>
                                            <option value="Phục hồi Keratin chuyên sâu">Phục hồi tóc</option>
                                            <option value="Combo Cắt + Uốn + Nhuộm">Combo Trọn Gói</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-gold w-100 py-2 fs-6 btn-booking-submit">
                                    <i class="bi bi-send me-1"></i> XÁC NHẬN ĐẶT HẸN
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features / Why Choose Us -->
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="row g-4 text-center">
                <div class="col-lg-3 col-md-6">
                    <div class="p-4 rounded-4 bg-light h-100 border transition-all hover-shadow">
                        <div class="fs-1 text-warning mb-3"><i class="bi bi-award-fill"></i></div>
                        <h5 class="fw-bold font-heading mb-2">Stylist Chuyên Nghiệp</h5>
                        <p class="text-muted small mb-0">Đội ngũ nhà tạo mẫu trên 10 năm kinh nghiệm tu nghiệp tại Nhật Bản
                            & Hàn Quốc.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="p-4 rounded-4 bg-light h-100 border transition-all hover-shadow">
                        <div class="fs-1 text-warning mb-3"><i class="bi bi-flower1"></i></div>
                        <h5 class="fw-bold font-heading mb-2">Mỹ Phẩm Hữu Cơ 100%</h5>
                        <p class="text-muted small mb-0">Sử dụng các dòng thuốc uốn, nhuộm, dưỡng organic bảo vệ da đầu và
                            cấu trúc tóc.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="p-4 rounded-4 bg-light h-100 border transition-all hover-shadow">
                        <div class="fs-1 text-warning mb-3"><i class="bi bi-shield-check"></i></div>
                        <h5 class="fw-bold font-heading mb-2">Bảo Hành Tóc 30 Ngày</h5>
                        <p class="text-muted small mb-0">Cam kết chỉnh sửa, dưỡng phục hồi hoàn toàn miễn phí nếu khách hàng
                            chưa hài lòng.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="p-4 rounded-4 bg-light h-100 border transition-all hover-shadow">
                        <div class="fs-1 text-warning mb-3"><i class="bi bi-cup-hot-fill"></i></div>
                        <h5 class="fw-bold font-heading mb-2">Không Gian Chuẩn Lounge</h5>
                        <p class="text-muted small mb-0">Thư giãn với trà bánh, không gian máy lạnh sang trọng và ghế gội
                            massage thư thái.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services & Pricing -->
    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="text-warning text-uppercase fw-bold letter-spacing-1 small">Dịch Vụ Đẳng Cấp</span>
                <h2 class="display-5 font-heading fw-bold text-dark mt-1">DỊCH VỤ & BẢNG GIÁ TẠI SALON</h2>
                <div class="mx-auto bg-warning" style="width: 60px; height: 3px;"></div>
            </div>

            <div class="row g-4">
                @forelse($services ?? [] as $service)
                    <div class="col-lg-3 col-md-6">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden service-card">
                            <div class="position-relative overflow-hidden" style="height: 220px;">
                                <img src="{{ get_image($service->image) }}"
                                    class="w-100 h-100 object-fit-cover transition-img" alt="{{ $service->name }}">
                                <div
                                    class="position-absolute bottom-0 start-0 w-100 p-2 bg-dark bg-opacity-50 text-white small">
                                    <i class="bi bi-tag-fill text-warning me-1"></i> {{ $service->name }}
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column p-3">
                                <h5 class="card-title fw-bold font-heading text-dark mb-2">{{ $service->name }}</h5>
                                <p class="card-text text-muted small flex-grow-1">
                                    {{ Str::limit(strip_tags($service->description ?: $service->content), 85) }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                    <a href="#booking-section" class="btn btn-sm btn-outline-gold w-100">
                                        <i class="bi bi-calendar-plus me-1"></i> Đặt lịch ngay
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Fallback Service Cards -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-body text-center p-4">
                                <i class="bi bi-scissors fs-1 text-warning mb-3 d-block"></i>
                                <h5 class="fw-bold font-heading">Cắt Tạo Kiểu Nữ / Nam</h5>
                                <p class="text-muted small">Cắt tỉa form tóc chuẩn tỷ lệ khuôn mặt, sấy tạo kiểu bồng bềnh.
                                </p>
                                <span class="badge bg-warning text-dark px-3 py-2 fs-6">Từ 150.000đ</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-body text-center p-4">
                                <i class="bi bi-water fs-1 text-warning mb-3 d-block"></i>
                                <h5 class="fw-bold font-heading">Uốn Sóng Lơi Organic</h5>
                                <p class="text-muted small">Uốn sóng tự nhiên, giữ nếp lâu mà tóc vẫn mềm mượt không khô
                                    xơ.</p>
                                <span class="badge bg-warning text-dark px-3 py-2 fs-6">Từ 600.000đ</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-body text-center p-4">
                                <i class="bi bi-palette fs-1 text-warning mb-3 d-block"></i>
                                <h5 class="fw-bold font-heading">Nhuộm Màu Thời Thượng</h5>
                                <p class="text-muted small">Nhuộm tông màu hot trend: Nâu tây, Trà sữa, Khói xám, Pastel
                                    sang trọng.</p>
                                <span class="badge bg-warning text-dark px-3 py-2 fs-6">Từ 500.000đ</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-body text-center p-4">
                                <i class="bi bi-magic fs-1 text-warning mb-3 d-block"></i>
                                <h5 class="fw-bold font-heading">Phục Hồi Keratin Chuyên Sâu</h5>
                                <p class="text-muted small">Tái sinh tóc hư tổn nặng do tẩy, uốn nhiều lần, trả lại độ đàn
                                    hồi.</p>
                                <span class="badge bg-warning text-dark px-3 py-2 fs-6">Từ 400.000đ</span>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('service') }}" class="btn btn-gold btn-lg px-5">
                    Xem Toàn Bộ Bảng Giá Dịch Vụ <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Lookbook / Hair Gallery Section -->
    <section class="py-5 bg-white" id="lookbook">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="text-warning text-uppercase fw-bold letter-spacing-1 small">Bộ Sưu Tập Xu Hướng</span>
                <h2 class="display-5 font-heading fw-bold text-dark mt-1">LOOKBOOK MẪU TÓC THỊNH HÀNH</h2>
                <p class="text-muted">Các tác phẩm được thực hiện trực tiếp bởi đội ngũ Master Stylist Salon Dũng Tokyo</p>
                <div class="mx-auto bg-warning" style="width: 60px; height: 3px;"></div>
            </div>

            <div class="row g-3">
                @forelse($albums ?? [] as $album)
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card border-0 rounded-4 overflow-hidden position-relative gallery-item shadow-sm">
                            <img src="{{ get_image($album->image) }}" class="w-100 object-fit-cover"
                                style="height: 300px;" alt="{{ $album->name }}">
                            <div class="gallery-overlay p-3 d-flex flex-column justify-content-end">
                                <h5 class="text-white fw-bold font-heading mb-1">{{ $album->name }}</h5>
                                <small class="text-warning"><i class="bi bi-eye"></i> Xem mẫu tóc thịnh hành</small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4 text-muted">
                        <i class="bi bi-images fs-2 d-block text-warning mb-2"></i>
                        Bộ sưu tập đang được cập nhật các mẫu tóc mới nhất 2026!
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Big Booking Section -->
    <section class="py-5 text-white" id="booking-section"
        style="background: linear-gradient(135deg, #181a1f, #0d0e11); border-top: 2px solid var(--salon-gold); border-bottom: 2px solid var(--salon-gold);">
        <div class="container py-4">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <span class="text-warning fw-bold text-uppercase letter-spacing-1">Ưu Đãi Đặc Biệt</span>
                    <h2 class="display-5 font-heading fw-bold text-white mb-3">ĐẶT LỊCH HẸN TRỰC TUYẾN</h2>
                    <p class="text-light-50 lead mb-4">
                        Để Salon Dũng Tokyo chuẩn bị chu đáo nhất cho trải nghiệm làm tóc của bạn, vui lòng điền thông tin
                        hẹn giờ bên cạnh. Đội ngũ tư vấn sẽ liên hệ xác nhận sau 5 phút!
                    </p>
                    <div class="d-flex flex-column gap-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="salon-icon-circle"><i class="bi bi-telephone-fill fs-5"></i></div>
                            <div>
                                <div class="small text-muted text-uppercase letter-spacing-1">Hotline Đặt Hẹn Nhanh</div>
                                <h5 class="fw-bold mb-0 text-white"><a
                                        href="tel:{{ setting_phone(setting_option('phone') ?: '0908691696') }}"
                                        class="text-white text-decoration-none hover-gold">{{ setting_option('phone') ?: '090 869 16 96' }}</a>
                                </h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="salon-icon-circle"><i class="bi bi-geo-alt-fill fs-5"></i></div>
                            <div>
                                <div class="small text-muted text-uppercase letter-spacing-1">Địa chỉ Salon</div>
                                <h5 class="fw-bold mb-0 text-white">
                                    {{ setting_option('address') ?: '46 Đ. Số 8, Phường 11, Gò Vấp, Thành phố Hồ Chí Minh' }}
                                </h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="salon-icon-circle"><i class="bi bi-clock-fill fs-5"></i></div>
                            <div>
                                <div class="small text-muted text-uppercase letter-spacing-1">Giờ Làm Việc</div>
                                <h5 class="fw-bold mb-0 text-white">08:30 - 20:30 (Thứ 2 - Chủ Nhật)</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card border-0 rounded-4 shadow-lg p-4 bg-dark text-white border border-secondary">
                        <div class="card-body p-0">
                            <h4 class="card-title font-heading fw-bold text-warning mb-3">PHIẾU ĐẶT HẸN DỊCH VỤ</h4>
                            <form action="{{ route('contact.submit') }}" method="POST" class="ajax-booking-form"
                                novalidate>
                                @csrf
                                <input type="hidden" name="contact[type]" value="booking">

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small text-light">Họ và tên <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="contact[name]"
                                            class="form-control bg-secondary text-white border-0 field-name"
                                            placeholder="Họ và tên..." required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small text-light">Số điện thoại <span
                                                class="text-danger">*</span></label>
                                        <input type="tel" name="contact[phone]"
                                            class="form-control bg-secondary text-white border-0 field-phone"
                                            placeholder="Số điện thoại..." required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small text-light">Ngày hẹn mong muốn <span
                                                class="text-danger">*</span></label>
                                        <input type="date" name="contact[date]"
                                            class="form-control bg-secondary text-white border-0 field-date"
                                            value="{{ date('Y-m-d') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small text-light">Khung giờ hẹn</label>
                                        <select name="contact[time]" class="form-select bg-secondary text-white border-0">
                                            <option value="09:00 - 11:00">09:00 - 11:00 Sáng</option>
                                            <option value="11:00 - 13:00">11:00 - 13:00 Trưa</option>
                                            <option value="13:00 - 15:00">13:00 - 15:00 Chiều</option>
                                            <option value="15:00 - 18:00">15:00 - 18:00 Chiều</option>
                                            <option value="18:00 - 20:30">18:00 - 20:30 Tối</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small text-light">Ghi chú yêu cầu dịch vụ / Mẫu tóc mong
                                            muốn</label>
                                        <textarea name="contact[content]" class="form-control bg-secondary text-white border-0 field-content" rows="3"
                                            placeholder="Ví dụ: Cắt uốn layer nữ, tư vấn màu nhuộm hợp da..."></textarea>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-gold btn-lg w-100 py-3 btn-booking-submit">
                                            <i class="bi bi-check-circle-fill me-2"></i> GỬI LỊCH HẸN NGAY
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest News / Hair Trends -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <span class="text-warning text-uppercase fw-bold letter-spacing-1 small">Kiến Thức & Xu Hướng</span>
                    <h2 class="display-6 font-heading fw-bold text-dark mt-1 mb-0">BÀI VIẾT & MẸO CHĂM SÓC TÓC</h2>
                </div>
                <a href="{{ route('news') }}" class="btn btn-outline-dark d-none d-md-inline-block">Xem tất cả bài
                    viết</a>
            </div>

            <div class="row g-4">
                @forelse($posts ?? [] as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                            <div style="height: 200px;" class="overflow-hidden">
                                <img src="{{ get_image($post->image) }}" class="w-100 h-100 object-fit-cover"
                                    alt="{{ $post->name }}">
                            </div>
                            <div class="card-body p-3 d-flex flex-column">
                                <small class="text-warning fw-bold mb-1"><i class="bi bi-calendar3 me-1"></i>
                                    {{ $post->created_at ? $post->created_at->format('d/m/Y') : '' }}</small>
                                <h5 class="card-title fw-bold font-heading text-dark mb-2">
                                    <a href="{{ route('news.detail', ['slug' => $post->slug, 'id' => $post->id]) }}"
                                        class="text-decoration-none text-dark hover-gold">
                                        {{ $post->name }}
                                    </a>
                                </h5>
                                <p class="card-text text-muted small flex-grow-1">
                                    {{ Str::limit(strip_tags($post->description ?: $post->content), 100) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-3">
                        Đang cập nhật các bài viết xu hướng tóc mới nhất.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .gallery-item {
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
        }

        .gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.85), transparent 60%);
            opacity: 0.9;
            transition: opacity 0.3s ease;
        }

        .hover-gold:hover {
            color: var(--salon-gold) !important;
        }

        .hover-shadow:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            border-color: var(--salon-gold) !important;
        }

        .letter-spacing-1 {
            letter-spacing: 1px;
        }

        /* Modern Validation Error UI */
        .error-feedback {
            color: #e63946;
            font-size: 0.8rem;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: 500;
            animation: fadeInDown 0.25s ease-out;
            width: 100%;
        }

        .error-feedback i {
            font-size: 0.88rem;
            flex-shrink: 0;
        }

        .is-invalid {
            border-color: #e63946 !important;
            box-shadow: 0 0 0 0.18rem rgba(230, 57, 70, 0.15) !important;
        }

        .input-group.is-invalid-group {
            border-radius: 0.375rem;
        }

        .input-group.is-invalid-group .form-control,
        .input-group.is-invalid-group .input-group-text {
            border-color: #e63946 !important;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-4px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Xử lý tất cả các form đặt lịch trên trang (Hero form & Big Booking form)
            document.querySelectorAll('.ajax-booking-form').forEach(function(form) {
                // Tự động xóa lỗi khi người dùng đang nhập
                form.querySelectorAll('input, select, textarea').forEach(function(input) {
                    input.addEventListener('input', function() {
                        clearInputError(this);
                    });
                    input.addEventListener('change', function() {
                        clearInputError(this);
                    });
                });

                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Xóa toàn bộ lỗi cũ trong form
                    form.querySelectorAll('.error-feedback').forEach(el => el.remove());
                    form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove(
                        'is-invalid'));
                    form.querySelectorAll('.is-invalid-group').forEach(el => el.classList.remove(
                        'is-invalid-group'));

                    let isValid = true;
                    const nameInput = form.querySelector('.field-name');
                    const phoneInput = form.querySelector('.field-phone');
                    const dateInput = form.querySelector('.field-date');

                    // 1. Validate Họ Tên
                    if (nameInput && !nameInput.value.trim()) {
                        showFieldError(nameInput, 'Vui lòng nhập họ và tên của bạn!');
                        isValid = false;
                    }

                    // 2. Validate Số Điện Thoại
                    if (phoneInput) {
                        const phoneVal = phoneInput.value.trim();
                        const phoneRegex = /(84|0[3|5|7|8|9])+([0-9]{8})\b/;
                        if (!phoneVal) {
                            showFieldError(phoneInput, 'Vui lòng nhập số điện thoại liên hệ!');
                            isValid = false;
                        } else if (phoneVal.length < 9 || phoneVal.length > 12) {
                            showFieldError(phoneInput,
                                'Số điện thoại không hợp lệ (9 - 11 chữ số)!');
                            isValid = false;
                        }
                    }

                    // 3. Validate Ngày Hẹn
                    if (dateInput && !dateInput.value) {
                        showFieldError(dateInput, 'Vui lòng chọn ngày hẹn làm tóc!');
                        isValid = false;
                    }

                    if (!isValid) {
                        return;
                    }

                    // Loading state cho button
                    const submitBtn = form.querySelector('.btn-booking-submit');
                    const originalBtnHtml = submitBtn ? submitBtn.innerHTML : '';
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML =
                            '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Đang gửi lịch hẹn...';
                    }

                    const formData = new FormData(form);

                    fetch(form.getAttribute('action'), {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(res => res.json().then(data => ({
                            status: res.status,
                            body: data
                        })))
                        .then(({
                            status,
                            body
                        }) => {
                            if (submitBtn) {
                                submitBtn.disabled = false;
                                submitBtn.innerHTML = originalBtnHtml;
                            }

                            if (status >= 200 && status < 300 && body.status === 'success') {
                                if (typeof Swal !== 'undefined') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Đặt Lịch Hẹn Thành Công!',
                                        text: body.message ||
                                            'Cảm ơn quý khách! Đội ngũ Salon Dũng Tokyo sẽ liên hệ xác nhận sau 5 phút.',
                                        confirmButtonColor: '#c5a059',
                                        confirmButtonText: 'Đồng ý'
                                    });
                                } else {
                                    alert(body.message || 'Đặt lịch hẹn thành công!');
                                }
                                form.reset();
                            } else {
                                if (body.errors) {
                                    for (let key in body.errors) {
                                        const fieldName = key.replace('contact.', '');
                                        const targetInput = form.querySelector(
                                            `[name="contact[${fieldName}]"]`);
                                        if (targetInput) {
                                            showFieldError(targetInput, body.errors[key][0]);
                                        }
                                    }
                                } else {
                                    const errorMsg = body.message ||
                                        'Đã có lỗi xảy ra, vui lòng kiểm tra lại thông tin!';
                                    if (typeof Swal !== 'undefined') {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Thông báo',
                                            text: errorMsg,
                                            confirmButtonColor: '#c5a059'
                                        });
                                    } else {
                                        alert(errorMsg);
                                    }
                                }
                            }
                        })
                        .catch(err => {
                            if (submitBtn) {
                                submitBtn.disabled = false;
                                submitBtn.innerHTML = originalBtnHtml;
                            }
                            console.error(err);
                            alert('Lỗi kết nối máy chủ, vui lòng thử lại!');
                        });
                });
            });

            function showFieldError(inputEl, message) {
                inputEl.classList.add('is-invalid');
                const inputGroup = inputEl.closest('.input-group');
                if (inputGroup) {
                    inputGroup.classList.add('is-invalid-group');
                }

                const parentContainer = inputEl.closest('.mb-3, .col-md-6, .col-6, .col-12') || inputEl.parentNode;

                // Xóa lỗi cũ trong block nếu có
                const oldErr = parentContainer.querySelector('.error-feedback');
                if (oldErr) oldErr.remove();

                const errDiv = document.createElement('div');
                errDiv.className = 'error-feedback';
                errDiv.innerHTML = `<i class="bi bi-exclamation-circle-fill"></i><span>${message}</span>`;

                if (inputGroup) {
                    inputGroup.insertAdjacentElement('afterend', errDiv);
                } else {
                    inputEl.insertAdjacentElement('afterend', errDiv);
                }
            }

            function clearInputError(inputEl) {
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
@endpush
