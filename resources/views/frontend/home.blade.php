@php
    use Carbon\Carbon;
    Carbon::setLocale('vi');
    $lc = app()->getLocale();
@endphp


@extends('frontend.layouts.master')
@section('seo')
    @php
        $seo['seo_type'] = 'website';
    @endphp
    @include('frontend.layouts.seo', $seo ?? [])
@endsection



@push('lib-style')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Pattaya&display=swap" rel="stylesheet">
@endpush


@push('head-script')
    {{-- <script>
        window.addEventListener("pageshow", () => {
            // update hidden input field
        });
    </script> --}}
    {!! RecaptchaV3::initJs() !!}
@endpush


@section('content')

    @include('frontend.layouts.menu')

    <main id="home">

        <section class="banner-video block1">

            <div class="position-relative">
                <figure class="mb-0">
                    <img src="{{ setting_option('banner_img') }}" alt="{{ setting_option('webtitle') }}" class="w-100">
                </figure>
                <div class="position-absolute container">
                    <h1 class="fw-500 mb-4">
                        {{ setting_option('banner_slogan') }}
                    </h1>
                </div>
            </div>
        </section>

        @php
            $album = \App\Models\Frontend\Album::where(['status' => 1, 'id' => 7])->first();
        @endphp

        <section class="section-lg bg-light block2">
            <div class="container py-5">

                <div class="row justify-content-center ">
                    <div class="col-md-8">
                        <h2 class="text-center h1 fw-700 sec_title">Dịch vụ làm tóc</h2>
                        <p class="text-center sec_text">
                            Tiệm chúng tôi cung cấp các dịch vụ cắt tóc theo mẫu, làm tóc, nhuộm tóc, nhuộm lông mày và lông mi, uốn tóc duỗi tóc và nhiều dịch vụ khác.
                        </p>
                    </div>
                </div>
                @if ($album)
                    <div class="row row-cols-2 row-cols-lg-3 my-4 g-3">
                        @foreach ($album->items()->orderbydesc('sort')->get() as $item)
                            <div class="col">
                                <div class="animate__animated animate__fadeInUp animate__slower">
                                    <figure class="img-res">
                                        <img src="{{ $item->image }}" class="img-fluid d-block mx-auto" alt="{{ $item->name }}" title="{{ $item->name }}">

                                    </figure>
                                    <div class="block-caption">
                                        <h4 class="text-center content_title">
                                            <a class="services-name" href="#">{{ $item->name }}</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </section>

        <section class="section block3">
            <div class="parallax-container">
                <div class="material-parallax parallax">
                    <img src="/upload/images/page/parallax-img-1.jpg" alt="" style="display: block; transform: translate3d(-50%, 3px, 0px);">
                </div>

                <div class="parallax-content text-center">
                    <div class="container">
                        <div class="row justify-content-md-center position-relative">
                            <div class="col-md-10">
                                <h2 class="fw-700">Dịch vụ làm tóc</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @php
            $album = \App\Models\Frontend\Album::where(['status' => 1, 'id' => 6])->first();
        @endphp

        <section class="section section-lg bg-light block3">

            <div class="container py-5">
                <div class="row justify-content-center mt-4">
                    <div class="col-md-8">
                        <h2 class="text-center h1 fw-700">Kiểu mẫu</h2>
                        <p class="text-center">Các kiểu mãu tóc tiệm chúng tôi phục vụ.</p>
                    </div>
                </div>

                @if ($album)
                    <div class="row row-cols-2 row-cols-lg-4 my-4">
                        @foreach ($album->items()->orderbydesc('sort')->get() as $item)
                            <div class="col">
                                <div class="animate__animated animate__fadeInUp">
                                    <figure class="img-res">
                                        <img src="{{ $item->image }}" class="img-fluid d-block mx-auto" alt="Cắt tóc" title="Cắt tóc">
                                    </figure>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <section class="section section-lg block4 bg-dark">

            <div class="container py-5">
                <div class="row justify-content-lg-between py-3">
                    <div class="col-lg-6">
                        <div class="wow animate__animated animate__slideInLeft" style="visibility: visible; animation-name: slideInLeft;">
                            <div class="decorative-square">
                                <img src="/upload/images/page/home-3.jpg" class="img-fluid mx-auto d-block" alt="" width="443" height="360">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="text-white mt-5">
                            <h2 class="fw-700 h1">Giới thiệu</h2>
                            <p class="fs-3 my-4">LÀM NGHỀ 20 NĂM KINH NGHIỆM</p>
                            <p class="fs-4">
                                Salon sử dụng sản phẩm chăm sóc tóc chuyên nghiệp như L'Oreal, GOLDWELL, thân thiên với môi trường và an toan cho sức khỏe
                                <br>
                                Uy tín, tạo niềm tin cho khách hàng
                            </p>
                            {{-- <a class="button button-md button-primary" href="#">view more</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section section-lg bg-light contacts" id="contact">

            <div class="container py-5">

                <div class="row row-cols-2 justify-content-center">

                    <div class="col-lg-5">

                        <h2 class="text-center text-sm-left mb-5">LIÊN HỆ</h2>

                        <dl class="row">
                            <dt class="col-sm-3">
                                <i class="far fa-2x fa-fw fa-phone"></i>
                            </dt>
                            <dd class="col-sm-9">
                                <h4><a href="tel:{{ setting_option('phoner') }}">{{ setting_option('phone') }}</a></h4>
                            </dd>

                            <dt class="col-sm-3">
                                <i class="far fa-2x fa-fw fa-map"></i>
                            </dt>
                            <dd class="col-sm-9">
                                <h4><a href="#">{{ setting_option('address') }}</a></h4>
                            </dd>
                            <dt class="col-sm-3">
                                <i class="far fa-2x fa-fw fa-paper-plane"></i>
                            </dt>
                            <dd class="col-sm-9">
                                <h4><a href="mailto:{{ setting_option('email') }}">{{ setting_option('email') }}</a></h4>
                            </dd>
                        </dl>
                    </div>

                    <div class="col-lg-5">
                        <h2 class="text-center text-sm-left mb-5">ĐỂ LẠI THÔNG TIN</h2>
                        <form id="contact_form" method="post" action="{{ route('contact.submit') }}" novalidate="novalidate">
                            @csrf
                            {!! RecaptchaV3::field('contact') !!}
                            <div class="form-floating mb-3">
                                <input type="text" name="contact[name]" class="form-control" id="name" value="" placeholder="Họ tên">
                                <label for="name">Họ tên</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" name="contact[email]" class="form-control" id="email" value="" placeholder="Email">
                                <label for="email">Email</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" name="contact[phone]" class="form-control" id="phone" value="" placeholder="Điện thoại">
                                <label for="phone">Điện thoại</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="contact[content]" id="content" placeholder="Xin để lại lời nhắn" style="height: 100px"></textarea>
                                <label for="content">Lời nhắn</label>
                            </div>

                            <div class="row justify-content-left">
                                <div class="col-12 col-sm-7 col-lg-5">
                                    <button type="button" class="btn btn-custom btn-contact-submit">@lang('Submit')</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>

        {{-- Partner (block5) --}}
        {{-- @include('frontend.includes.partner') --}}

        {{-- Subscribe --}}
        {{-- @include('frontend.includes.subscribe') --}}
    </main>
@endsection

@push('scripts')
    <script>
        const studentSlider = new Swiper('.swiperSlider', {
            // Optional parameters
            // direction: 'vertical',
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            speed: 1000,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            effect: "fade",
            fadeEffect: {
                crossFade: true
            },
            // If we need pagination
            // pagination: {
            //     el: '.swiper-pagination',
            // },

            // Navigation arrows
            navigation: {
                enabled: true,
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                // 576: {
                //     slidesPerView: 2,
                // },
                // 992: {
                //     slidesPerView: 3,
                // },
                // 1200: {
                //     slidesPerView: 3,
                //     navigation: {
                //         enabled: true,
                //         nextEl: ".swiper-button-next",
                //         prevEl: ".swiper-button-prev",
                //     },
                // },
            },

            // And if we need scrollbar
            // scrollbar: {
            //     el: '.swiper-scrollbar',
            // },
        });
    </script>


    <script>
        // CONTACT
        var contact_form = $("#contact_form");
        var lc = '{{ app()->getLocale() }}';
        var contact_success = '{{ route('contact.completed') }}';

        var error_messages = {
            "contact[name]": "@lang('Enter first last name')",
            "contact[email]": {
                required: "@lang('Enter email')",
                email: "@lang('Enter valid email')",
            },
            "contact[phone]": {
                required: "@lang('Enter phone')",
                number: "@lang('Enter valid phone')",
                digits: "@lang('Enter valid phone')",
                minlength: "@lang('Enter valid phone')",
            },
            "contact[content]": {
                required: "@lang('Enter content')",
                minlength: "@lang('Enter minimum characters')",
                maxlength: "@lang('Enter maximun characters')",
            }
        }

        $(function() {
            contact_form.validate({
                onfocusout: false,
                onkeyup: false,
                onclick: false,
                rules: {
                    "contact[name]": "required",
                    "contact[email]": {
                        required: true,
                        email: true,
                    },
                    "contact[phone]": {
                        required: true,
                        number: true,
                        digits: true,
                        minlength: 10,
                    },
                    "contact[content]": {
                        required: true,
                        minlength: 10,
                        maxlength: 200,
                    },
                },
                messages: error_messages,
                errorElement: "div",
                errorLabelContainer: ".errorTxt",
                invalidHandler: function(event, validator) {
                    $("html, body").animate({
                        scrollTop: contact_form.offset().top
                    }, 500);
                },
            });

            $('.btn-contact-submit').on('click', function(event) {
                if (contact_form.valid()) {
                    var form = document.getElementById('contact_form');
                    var fdnew = new FormData(form);
                    axios({
                        method: 'POST',
                        url: contact_form.prop("action"),
                        data: fdnew,
                    }).then(res => {
                        if (res.data.status == "success") {
                            console.log('success');
                            window.location.replace(contact_success);
                        } else {
                            Swal.fire({
                                position: "center",
                                icon: "error",
                                title: res.data.message,
                                // showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    }).catch(e => console.log(e));
                }
            });
        });
    </script>
@endpush
