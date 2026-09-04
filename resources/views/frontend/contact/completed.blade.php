@extends('frontend.layouts.master')

@section('content')
<div class="contact-completed py-5" style="background-color: #f8f9fa; min-height: 70vh;">
    <div class="container py-3">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}" class="text-decoration-none text-muted">Trang chủ</a></li>
                <li class="breadcrumb-item active text-gold fw-semibold" aria-current="page">Hoàn tất liên hệ</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="bg-white rounded-4 shadow-sm p-4 p-md-5 text-center border">
                    {{-- Icon Checkmark --}}
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 shadow-sm"
                        style="width: 80px; height: 80px; background: linear-gradient(135deg, #dfba73, #c5a059); color: #fff;">
                        <i class="bi bi-check2-circle fs-1"></i>
                    </div>

                    <h1 class="h3 fw-bold text-dark font-heading mb-2">Gửi Liên Hệ Thành Công!</h1>

                    @if (session('contact_name'))
                        <p class="fs-5 fw-bold text-gold mb-2">
                            Cảm ơn quý khách {{ session('contact_name') }}!
                        </p>
                    @endif

                    <p class="text-muted mb-4 mx-auto" style="max-width: 580px;">
                        Chúng tôi đã nhận được thông tin câu hỏi / yêu cầu đặt lịch hẹn của bạn. Đội ngũ Stylist và chuyên viên của Salon Dũng Tokyo sẽ liên hệ lại với bạn trong thời gian sớm nhất (thường sau 5 - 10 phút).
                    </p>

                    <div class="row g-3 justify-content-center mb-4 text-start">
                        <div class="col-md-5">
                            <a href="tel:{{ setting_phone(setting_option('phone') ?: '0908691696') }}"
                                class="card text-decoration-none border shadow-sm h-100 p-3 rounded-3 text-dark hover-card-lift">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="salon-icon-circle bg-gold-subtle text-gold p-3 rounded-circle">
                                        <i class="bi bi-telephone-fill fs-5"></i>
                                    </div>
                                    <div>
                                        <div class="small text-muted fw-semibold">Hotline & Zalo hỗ trợ</div>
                                        <div class="fw-bold text-gold">{{ setting_option('phone') ?: '090 869 16 96' }}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-5">
                            <a href="mailto:{{ setting_option('email_admin') ?: 'contact@salondungtokyo.vn' }}"
                                class="card text-decoration-none border shadow-sm h-100 p-3 rounded-3 text-dark hover-card-lift">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="salon-icon-circle bg-gold-subtle text-gold p-3 rounded-circle">
                                        <i class="bi bi-envelope-fill fs-5"></i>
                                    </div>
                                    <div>
                                        <div class="small text-muted fw-semibold">Hộp thư điện tử</div>
                                        <div class="fw-bold text-dark text-truncate" style="max-width: 180px;">
                                            {{ setting_option('email_admin') ?: 'contact@salondungtokyo.vn' }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="{{ route('index') }}" class="btn btn-gold px-4 py-2 rounded-pill fw-bold shadow-sm">
                            <i class="bi bi-house-door-fill me-1"></i> Về trang chủ
                        </a>
                        <a href="{{ route('contact.index') }}"
                            class="btn btn-outline-secondary px-4 py-2 rounded-pill fw-semibold">
                            Gửi yêu cầu khác
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
