@php
    use Carbon\Carbon;
    Carbon::setLocale('vi');
    $lc = app()->getLocale();
    // $category_product = Menu::getByName('Categories-product-home');
@endphp

@extends($templatePath . '.layouts.index')

@section('seo')
    @php $seo['seo_type'] = 'website';@endphp
    @include('theme.layouts.seo', $seo ?? [])
@endsection

@section('content')
    @include('theme.layouts.menu')

    {{-- <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 px-0">
                <div class="ratio ratio-16x9">
                    <video class="object-fit-cover" muted loop autoplay>
                        <source src="/upload/files/office.mp4" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </div> --}}

    <main id="home">
        [slider id=1 items=4]

        {{-- block2 --}}
        [block_service items=3]

        {{-- Partner (block5) --}}
        @include('theme.includes.partner')

        <section class="block10" style="background: #2d2d2d">
            <div class="container py-5">
                <div class="row justify-content-center align-items-center">
                    <div class="col-8">
                        <h4 class="h2 text-white mb-0">
                            Để hiểu thêm về dịch vụ<br>Đừng ngần ngại liên hệ với chúng tôi
                        </h4>
                    </div>
                    <div class="col-4 text-end">
                        <a href="{{ route('page', 'contact') }}" class="btn btn-custom ">Liên hệ</a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Subscribe --}}
        {{-- @include('theme.includes.subscribe') --}}
    </main>
@endsection

@push('scripts')
    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     const el = document.querySelector('.counter');
        //     // Tiếp tục xử lý tại đây...
        // });

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

        const swiperContent = new Swiper('.swiperContent', {
            // Optional parameters
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            speed: 1000,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            // effect: "fade",
            // fadeEffect: {
            //     crossFade: true
            // },
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
                576: {
                    slidesPerView: 2,
                },
                992: {
                    slidesPerView: 4,
                },
            },

            // And if we need scrollbar
            // scrollbar: {
            //     el: '.swiper-scrollbar',
            // },
        });
    </script>
@endpush
