@php
    $partner = \App\Models\AlbumItem::where('album_id', 2)->orderBy('sort', 'asc')->get();
@endphp

<section class="block5">
    <div class="container pt-5">
        <div class="row">
            <div class="col">
                <h2 class="sec_h">
                    @lang('Our partners')
                    <sup>{{ $partner->count() }}</sup>
                </h2>
            </div>
        </div>

    </div>
    <div class="container-fluid pb-5">
        <div class="swiper partnerSlider mt-3">
            <div class="swiper-wrapper d-flex align-items-center">
                @foreach ($partner as $item)
                    <div class="swiper-slide">
                        <img class="img-fluid d-block mx-auto" src="{{ get_image($item->image) }}" alt="{{ $item->name }}">
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>


@push('scripts')
    {{-- Initialize Swiper --}}
    <script>
        var partnerSlider = new Swiper(".partnerSlider", {
            slidesPerView: 2,
            spaceBetween: 30,
            grabCursor: true,
            a11y: false,
            freeMode: true,
            speed: 10000,
            loop: true,
            autoplay: {
                delay: 0.5,
                disableOnInteraction: false,
            },
            breakpoints: {
                576: {
                    slidesPerView: 3,
                },
                768: {
                    slidesPerView: 4,
                },
                992: {
                    slidesPerView: 6,
                },
                1200: {
                    slidesPerView: 8,
                },
            },
            // pagination: {
            //     el: ".swiper-pagination",
            //     clickable: true,
            // },
        });
    </script>
@endpush
