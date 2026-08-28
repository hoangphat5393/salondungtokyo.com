@extends('frontend.layouts.master')

@section('content')
<section class="py-5 bg-dark text-white text-center position-relative" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset('upload/images/banner_hero.jpg') }}') center/cover;">
    <div class="container py-4">
        <h1 class="display-4 fw-bold font-heading text-warning mb-2">LIÊN HỆ & ĐẶT LỊCH HẸN</h1>
        <p class="lead text-light mb-0">Chúng tôi luôn sẵn sàng lắng nghe và tư vấn phong cách tóc hoàn hảo nhất cho bạn</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container py-3">
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                    <h4 class="font-heading fw-bold text-dark mb-4 pb-2 border-bottom">THÔNG TIN SALON</h4>

                    <div class="d-flex flex-column gap-4">
                        <div class="d-flex align-items-start gap-3">
                            <div class="salon-icon-circle"><i class="bi bi-geo-alt-fill fs-5"></i></div>
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Địa chỉ chi nhánh:</h6>
                                <p class="text-muted mb-0">{{ setting_option('address') ?: '46 Đ. Số 8, Phường 11, Gò Vấp, Thành phố Hồ Chí Minh' }}</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3">
                            <div class="salon-icon-circle"><i class="bi bi-telephone-fill fs-5"></i></div>
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Hotline & Zalo:</h6>
                                <p class="text-muted mb-0"><a href="tel:{{ setting_phone(setting_option('phone') ?: '0908691696') }}" class="text-decoration-none text-dark fw-bold hover-gold">{{ setting_option('phone') ?: '090 869 16 96' }}</a></p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3">
                            <div class="salon-icon-circle"><i class="bi bi-clock-fill fs-5"></i></div>
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Thời gian phục vụ:</h6>
                                <p class="text-muted mb-0">08:30 - 20:30 (Mở cửa tất cả các ngày trong tuần)</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3">
                            <div class="salon-icon-circle"><i class="bi bi-envelope-fill fs-5"></i></div>
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Email phản hồi:</h6>
                                <p class="text-muted mb-0">{{ setting_option('email_admin') ?: 'contact@salondungtokyo.vn' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <h4 class="font-heading fw-bold text-dark mb-2">GỬI YÊU CẦU TƯ VẤN</h4>
                    <p class="text-muted small mb-4">Vui lòng để lại lời nhắn, chuyên viên của chúng tôi sẽ gọi lại ngay.</p>

                    <form action="{{ route('contact.submit') }}" method="POST" class="ajax-contact-form">
                        @csrf
                        <input type="hidden" name="contact[type]" value="contact_page">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark small">Họ và tên *</label>
                                <input type="text" name="contact[name]" class="form-control py-2" placeholder="Nhập họ tên của bạn..." required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark small">Số điện thoại *</label>
                                <input type="tel" name="contact[phone]" class="form-control py-2" placeholder="Nhập số điện thoại..." required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold text-dark small">Email liên hệ (nếu có)</label>
                                <input type="email" name="contact[email]" class="form-control py-2" placeholder="Nhập email...">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold text-dark small">Nội dung câu hỏi / Dịch vụ muốn tư vấn</label>
                                <textarea name="contact[content]" rows="4" class="form-control" placeholder="Ví dụ: Tôi muốn tư vấn bảng giá uốn phục hồi và đặt lịch làm tóc vào 15h chiều nay..."></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-gold btn-lg w-100 py-2">
                                    <i class="bi bi-send-fill me-2"></i> GỬI YÊU CẦU NGAY
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
