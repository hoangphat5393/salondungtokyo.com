@php
    extract($data);
    $lc = app()->getLocale();
    $slider = \App\Slider::where(['status' => 1, 'id' => $slider_id])->first();
@endphp

@if ($slider)
    <section class="section_staff my-3">
        <div class="container">
            <div class="row">
                {{-- <div class="col-lg-12 mb-3">
                    <h3 class="text-center fs-1">
                        {{ $slider->name }}
                    </h3>
                </div> --}}
                @foreach ($slider->children as $item)
                    <div class="col-12 col-md-6 col-lg-{{ $column }} my-5">
                        <div class="position-relative">
                            <div class="wrap-block h-100 p-4">
                                <img class="img-fluid w-100 mb-3" src="{{ get_image($item->image) }}" alt="{{ $item->name }}">
                                <p class="text-main text-center fw-bold">{{ $item->name }}</p>
                                @if ($item->sub_name)
                                    <p class="text-main text-center">{{ $item->sub_name }}</p>
                                @endif
                                {{-- <div class="text-main fw-semibold">
                                    {!! htmlspecialchars_decode($item->description) !!}
                                </div> --}}
                            </div>
                            <div class="position-image">
                                <img class="img-fluid" src="{{ setting_option('logo_' . $lc) }}" alt="{{ $item->name }}">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
