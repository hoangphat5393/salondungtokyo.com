@php
    use Carbon\Carbon;
    Carbon::setLocale('vi');
@endphp

@empty(!$services)
    <section class="block4">

        <div class="container-lg py-5">

            <div class="d-flex align-items-center justify-content-between py-4">
                <div class="col">
                    <h2 class="sec_h mb-0">@lang('Service')<sup>{{ $services->count() }}</sup></h2>
                </div>
                <div class="col text-end">
                    <a href="{{ route('service') }}" class="btn btn-custom">@lang('All Services')</a>
                </div>
            </div>

            <div class="row">
                <div class="col">

                    <div class="swiper swiperContent">
                        {{-- Additional required wrapper --}}
                        <div class="swiper-wrapper">
                            @foreach ($services as $item)
                                <div class="swiper-slide">
                                    <div class="block-img">
                                        <a href="{{ route('service.detail', [$item->slug, $item->id]) }}">
                                            <figure class="mb-0">
                                                <img class="img-fluid swiper-image object-fit-cover" src="{{ get_image($item->image) }}" alt="{{ $item->name }}">
                                            </figure>

                                            <div class="title-content d-flex align-items-center">
                                                <i class="{{ $item->icon }} fa-2x fa-fw"></i> &emsp;
                                                <h5 class="mb-0">{{ $item->name }}</h5>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- If we need pagination -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>

                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        <!-- If we need scrollbar -->
                        {{-- <div class="swiper-scrollbar"></div> --}}
                    </div>
                </div>
            </div>
        </div>

    </section>
@endempty

@push('name')
    <script>
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
                    slidesPerView: 3,
                },
            },

            // And if we need scrollbar
            // scrollbar: {
            //     el: '.swiper-scrollbar',
            // },
        });
    </script>
@endpush
