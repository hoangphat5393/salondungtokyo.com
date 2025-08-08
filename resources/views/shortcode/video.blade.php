@php
    // use Carbon\Carbon;
    // Carbon::setLocale('vi');
    // $project = \App\Campaign::limit($items)->paginate(6);
@endphp


@if ($slider)
    <section class="">
        <div class="container-fluid px-0">
            @if ($slider->items)
                {{-- Slider main container --}}
                <div class="swiper swiperSlider">

                    {{-- Additional required wrapper --}}
                    <div class="swiper-wrapper">
                        @foreach ($slider->items as $item)
                            <div class="swiper-slide">
                                <div class="res-img">
                                    <img class="w-100 swiper-image object-fit-cover" src="{{ get_image($item->image) }}" alt="{{ $item->name }}">
                                </div>
                                {{-- <h5 class="my-3">{{ $item->name }}</h5>
                                {!! htmlspecialchars_decode($item->description) !!} --}}
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
            @endif
        </div>
    </section>
@endif
