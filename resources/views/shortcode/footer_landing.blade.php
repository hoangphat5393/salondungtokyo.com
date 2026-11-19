@php
    extract($data);
    $lc = app()->getLocale();
@endphp

<footer class="footer-landing" style="background-color:{{ $bg_color }}">
    <div class="container-fluid px-0">
        <div class="row gx-0">
            <div class="col-lg-4">
                <img src="{{ get_image($image) }}" class="img-fluid object-fit-cover swiper-image d-block w-100 h-100" alt="" />
            </div>
            <div class="col-lg-8">
                <div class="right-content h-100 p-4 d-flex flex-column">
                    <div class="row gx-0">
                        <div class="col-lg-6">
                            <p class="fw-bold mb-3">HỔ TRỢ TƯ VẤN & GIẢI ĐÁP THẮC MẮC</p>
                            <br>
                            <p class="mb-3"><i class="fas fa-phone"></i> <a href="tel:02871011115">02871011115</a></p>
                            <p class="mb-3"><i class="fas fa-globe"></i> <a href="{{ route('index') }}">{{ route('index') }}</a></p>
                            <p class="mb-3"><i class="far fa-envelope"></i> <a href="mailto:info@droh.co">info@droh.co</a></p>
                            <p class="mb-3"><i class="fas fa-map-marker-alt"></i> {{ setting_option('address') }}</p>
                        </div>
                        <div class="col-lg-6">
                            <p class="fw-bold">HƯỚNG DẪN TẢI APP DR.OH BỆNH VIỆN ĐA KHOA BỎ TÚI. NỀN TẢNG Y TẾ TRỰC TUYẾN HÀNG ĐẦU VIỆT NAM</p>
                            <br>
                            <div class="row">
                                <div class="col-lg-8">
                                    <ul>
                                        <li>Nhập tìm kiếm <DR.OH> trên App Store, CH Play hoặc quét mã QR</li>
                                        <li>Chọn biểu tượng ứng dụng DR.OH và cài đặt miễn phí</li>
                                        <li>Link tải úng dụng Dr.OH:<br>
                                            <strong>+ Android</strong>: <a href="{{ setting_option('android') }}">{{ setting_option('android') }}</a>
                                            <br>
                                            <strong>+ IOS</strong>: <a href="{{ setting_option('ios') }}">{{ setting_option('ios') }}</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-4">
                                    <img src="{{ asset('landing/qr-code.png') }}" class="img-fluid d-block mx-auto " alt="QR CODE">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-auto">
                        <div class="col-lg-12">
                            <p>© 2018 ONEHEALTH FOUNDATION. ALL RIGHTS RESERVED.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
