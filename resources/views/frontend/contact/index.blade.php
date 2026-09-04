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
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}" class="text-decoration-none text-muted">Trang chủ</a></li>
                <li class="breadcrumb-item active text-gold fw-semibold" aria-current="page">Liên hệ</li>
            </ol>
        </nav>

        <div class="row g-4">
            {{-- Cột trái: Thông tin Salon --}}
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                    <h4 class="font-heading fw-bold text-dark mb-4 pb-2 border-bottom">THÔNG TIN SALON</h4>

                    <div class="d-flex flex-column gap-4">
                        <div class="d-flex align-items-start gap-3">
                            <div class="salon-icon-circle bg-gold-subtle text-gold p-3 rounded-circle">
                                <i class="bi bi-geo-alt-fill fs-5"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Địa chỉ chi nhánh:</h6>
                                <p class="text-muted mb-0">{{ setting_option('address') ?: '46 Đ. Số 8, Phường 11, Gò Vấp, Thành phố Hồ Chí Minh' }}</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3">
                            <div class="salon-icon-circle bg-gold-subtle text-gold p-3 rounded-circle">
                                <i class="bi bi-telephone-fill fs-5"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Hotline & Zalo:</h6>
                                <p class="text-muted mb-0"><a href="tel:{{ setting_phone(setting_option('phone') ?: '0908691696') }}" class="text-decoration-none text-dark fw-bold hover-gold">{{ setting_option('phone') ?: '090 869 16 96' }}</a></p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3">
                            <div class="salon-icon-circle bg-gold-subtle text-gold p-3 rounded-circle">
                                <i class="bi bi-clock-fill fs-5"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Thời gian phục vụ:</h6>
                                <p class="text-muted mb-0">08:30 - 20:30 (Mở cửa tất cả các ngày trong tuần)</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3">
                            <div class="salon-icon-circle bg-gold-subtle text-gold p-3 rounded-circle">
                                <i class="bi bi-envelope-fill fs-5"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Email phản hồi:</h6>
                                <p class="text-muted mb-0">{{ setting_option('email_admin') ?: 'contact@salondungtokyo.vn' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Cột phải: Form gửi tin nhắn --}}
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
                    <h4 class="font-heading fw-bold text-dark mb-2">GỬI YÊU CẦU TƯ VẤN</h4>
                    <p class="text-muted small mb-3">Vui lòng để lại thông tin, chuyên viên của chúng tôi sẽ liên hệ lại ngay.</p>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (isset($errors) && $errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $errors->first() }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form id="form-contact" class="form-contact" method="post" action="{{ route('contact.submit') }}" novalidate="novalidate">
                        @csrf
                        <input type="hidden" name="contact[type]" value="contact">

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" class="form-control py-2" id="Contact_Name" name="contact[name]"
                                    placeholder="Họ & tên của bạn" required value="{{ old('contact.name') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control py-2" id="Contact_Mobile" name="contact[phone]"
                                    placeholder="Số điện thoại" required value="{{ old('contact.phone') }}">
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Email</label>
                                <input type="email" class="form-control py-2" id="Contact_Email" name="contact[email]"
                                    placeholder="Địa chỉ email (nếu có)" value="{{ old('contact.email') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Địa chỉ</label>
                                <input type="text" class="form-control py-2" id="Contact_Address" name="contact[address]"
                                    placeholder="Địa chỉ của bạn" value="{{ old('contact.address') }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-dark">Lời nhắn / Nội dung cần tư vấn <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="Contact_Message" name="contact[content]" rows="4"
                                placeholder="Ví dụ: Tôi muốn tư vấn kiểu uốn sóng lơi và đặt lịch làm tóc lúc 15h..." required>{{ old('contact.content') }}</textarea>
                        </div>

                        <div class="mt-4">
                            <button type="button" class="btn btn-gold btn-contact-submit btn-lg w-100 py-2 fw-semibold">
                                <i class="bi bi-send-fill me-2"></i> GỬI LIÊN HỆ NGAY
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Google Maps Embed if available --}}
        @if (setting_option('google_map'))
            <div class="row mt-4">
                <div class="col-12">
                    <div class="overflow-hidden rounded-4 shadow-sm border" style="height: 380px;">
                        <iframe src="{{ setting_option('google_map') }}" width="100%" height="100%"
                            style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

@push('head-script')
    @if (config('recaptchav3.sitekey'))
        {!! RecaptchaV3::initJs() !!}
    @endif
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const contactForm = document.getElementById('form-contact');
            const submitBtn = document.querySelector('.btn-contact-submit');

            if (submitBtn && contactForm) {
                // Hàm hiển thị lỗi bên dưới input
                function showInputError(inputEl, message) {
                    inputEl.classList.add('is-invalid');
                    const feedback = document.createElement('div');
                    feedback.className = 'invalid-feedback error-feedback d-block';
                    feedback.innerText = message;
                    inputEl.parentNode.appendChild(feedback);
                }

                // Xóa lỗi khi người dùng gõ
                contactForm.querySelectorAll('input, textarea').forEach(function(input) {
                    input.addEventListener('input', function() {
                        this.classList.remove('is-invalid');
                        const err = this.parentNode.querySelector('.error-feedback');
                        if (err) err.remove();
                    });
                    input.addEventListener('change', function() {
                        this.classList.remove('is-invalid');
                        const err = this.parentNode.querySelector('.error-feedback');
                        if (err) err.remove();
                    });
                });

                submitBtn.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Xóa các thông báo lỗi cũ
                    document.querySelectorAll('.error-feedback').forEach(el => el.remove());
                    document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

                    let isValid = true;
                    const nameInput = document.getElementById('Contact_Name');
                    const phoneInput = document.getElementById('Contact_Mobile');
                    const emailInput = document.getElementById('Contact_Email');
                    const contentInput = document.getElementById('Contact_Message');

                    // Validate Name
                    if (!nameInput.value.trim()) {
                        showInputError(nameInput, 'Vui lòng nhập họ và tên!');
                        isValid = false;
                    }

                    // Validate Phone
                    const phoneVal = phoneInput.value.trim();
                    if (!phoneVal) {
                        showInputError(phoneInput, 'Vui lòng cung cấp số điện thoại!');
                        isValid = false;
                    } else if (phoneVal.length < 9) {
                        showInputError(phoneInput, 'Số điện thoại tối thiểu 9 số!');
                        isValid = false;
                    }

                    // Validate Email (nếu có nhập)
                    const emailVal = emailInput.value.trim();
                    if (emailVal && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailVal)) {
                        showInputError(emailInput, 'Địa chỉ email không đúng định dạng!');
                        isValid = false;
                    }

                    // Validate Content
                    const contentVal = contentInput.value.trim();
                    if (!contentVal) {
                        showInputError(contentInput, 'Vui lòng nhập nội dung lời nhắn!');
                        isValid = false;
                    } else if (contentVal.length < 5) {
                        showInputError(contentInput, 'Nội dung lời nhắn tối thiểu 5 ký tự!');
                        isValid = false;
                    }

                    if (!isValid) {
                        return;
                    }

                    // Chuyển nút sang trạng thái loading
                    const originalBtnHtml = submitBtn.innerHTML;
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Đang gửi...';

                    const formData = new FormData(contactForm);

                    fetch(contactForm.getAttribute('action'), {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json().then(data => ({
                        status: response.status,
                        body: data
                    })))
                    .then(({ status, body }) => {
                        if (status >= 200 && status < 300 && body.status === 'success') {
                            window.location.href = body.redirect || '{{ route('contact.completed') }}';
                        } else {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalBtnHtml;
                            if (body.errors) {
                                for (let key in body.errors) {
                                    const fieldName = key.replace('contact.', '');
                                    let fieldEl = null;
                                    if (fieldName === 'name') fieldEl = nameInput;
                                    if (fieldName === 'phone') fieldEl = phoneInput;
                                    if (fieldName === 'email') fieldEl = emailInput;
                                    if (fieldName === 'content') fieldEl = contentInput;

                                    if (fieldEl) {
                                        showInputError(fieldEl, body.errors[key][0]);
                                    }
                                }
                            } else {
                                alert(body.message || 'Đã có lỗi xảy ra, vui lòng thử lại!');
                            }
                        }
                    })
                    .catch(err => {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalBtnHtml;
                        alert('Lỗi kết nối máy chủ, vui lòng thử lại!');
                    });
                });
            }
        });
    </script>
@endpush

