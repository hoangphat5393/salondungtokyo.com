@php
    extract($data);
    $lc = app()->getLocale();
@endphp

<footer class="footer-landing">
    <div class="container-fluid px-0 mt-3">
        <div class="row gx-0">
            <div class="col-lg-4">
                <img src="{{ asset('landing/landing1.png') }}" class="img-fluid object-fit-cover swiper-image d-block w-100 h-100" alt="" />
            </div>
            <div class="col-lg-8">
                <div class="right-content h-100 p-4">
                    <div class="row gx-0">
                        <div class="col-lg-6">
                            <p class="fw-bold mb-3">HỖ TRỢ TƯ VẤN & GIẢI ĐÁP THẮC MẮC</p>
                            <p class="mb-3"><i class="fas fa-phone"></i> <a href="tel:02871011115">02871011115</a></p>
                            <p class="mb-3"><i class="fas fa-globe"></i> <a href="{{ route('index') }}">{{ route('index') }}</a></p>
                            <p class="mb-3"><i class="fas fa-globe"></i> <a href="https://www.drkhoa.com/">https://www.drkhoa.com/</a></p>
                            <p class="mb-3"><i class="far fa-envelope"></i> <a href="mailto:info@drkhoa.com">info@drkhoa.com</a></p>
                            <p class="mb-3"><i class="fas fa-map-marker-alt"></i> 116 Gò Dầu, P.Tân Quý, Q.Tân Phú, TP.HCM</p>
                            <p class="mb-3"><i class="fas fa-map-marker-alt"></i> COMING SOON: Quận Phú nhuận</p>
                        </div>
                        <div class="col-lg-6">
                            <p class="fw-bold">HƯỚNG DẪN TẢI APP DR.OH BỆNH VIỆN ĐA KHOA BỎ TÚI. NỀN TẢNG Y TẾ TRỰC TUYẾN HÀNG ĐẦU VIETNAM</p>
                            <br>
                            <div class="row">
                                <div class="col-lg-6">
                                    <ul>
                                        <li>Nhập tìm kiếm &lt;DR.OH&gt; trên App Store, CH Play hoặc quét mã QR</li>
                                        <li>Chọn biểu tượng ứng dụng DR.OH và cài đặt miễn phí</li>
                                        <li>Link tải ứng dụng Dr.OH:<br>
                                            <strong>+ Android</strong>: <a href="https://goo.gl/c2Fek7">goo.gl/c2Fek7</a><strong><br>
                                                + IOS</strong>: <a href="https://goo.gl/GhX99B">goo.gl/GhX99B</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <img src="{{ asset('landing/qr-code.png') }}" class="img-fluid d-block mx-auto my-4" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
