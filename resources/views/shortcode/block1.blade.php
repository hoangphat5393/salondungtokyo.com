@php
    use Carbon\Carbon;
    Carbon::setLocale('vi');
    // extract($data);
    // $works = \App\Work::limit($items)->get();
@endphp

@empty(!$work)
    <section class="block1">
        <div class="container py-5">

            <div class="row justify-content-center py-5">
                {{-- <div class="col-lg-6">
                    <img src="/upload/images/page/logo_1.png" alt="" class="img-fluid d-block mx-auto">
                </div> --}}
                <div class="col-lg-6">
                    <h2 class="fw-700">Về chúng tôi</h2>
                    <p class="fw-500">
                        Xuất thân từ ngành công nghiệp giải trí về đêm năng động và trẻ trung<br><br>
                        Seven.T Agency chuyên cung cấp giải pháp sáng tạo đột phá cho các doanh nghiệp F&B và Nightlife.<br><br>
                        Với đội ngũ chuyên gia giàu kinh nghiệm và sự hiểu biết sâu sắc về thị trường, chúng tôi cam kết mang lại những giải pháp độc đáo và hiệu quả nhất cho khách hàng của mình.
                    </p>
                    <img src="/upload/images/sevent_agency_logo.webp" alt="" class="img-fluid">
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-3 gy-3">
                <div class="col">
                    <div class="box-content">
                        <img src="/upload/images/icon/guarantee_item_image_1.webp" alt="" class="img-fluid d-block mx-auto icon">
                        <h2 class="fw-700">Tận tâm</h2>
                        <p>Lan tỏa giá trị thương hiệu đến cộng đồng một cách tích cực và bền vững.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="box-content">
                        <img src="/upload/images/icon/guarantee_item_image_2.webp" alt="" class="img-fluid d-block mx-auto icon">
                        <h2 class="fw-700">Sáng tạo</h2>
                        <p>
                            Tạo ra các ý tưởng mới lạ, phù hợp với xu hướng và đáp ứng tối đa nhu cầu.
                        </p>
                    </div>
                </div>
                <div class="col">
                    <div class="box-content">
                        <img src="/upload/images/icon/guarantee_item_image_3.webp" alt="" class="img-fluid d-block mx-auto icon">
                        <h2 class="fw-700">Phát triển</h2>
                        <p>
                            Đẩy mạnh độ nhận biết, tin tưởng, yêu thích dành cho Thương hiệu.
                        </p>
                    </div>
                </div>
            </div>

            <div class="text-center my-5">
                <a href="{{ route('page', 'about') }}" class="btn btn-custom">Xem thêm</a>
            </div>

        </div>
    </section>
@endempty
