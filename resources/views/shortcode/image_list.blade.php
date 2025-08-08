@php
    extract($data);
    $lc = app()->getLocale();
    $album = \App\Album::where(['status' => 1, 'id' => $slider_id])->first();
@endphp

@if ($album)
    <section class="image_list py-5">
        <div class="container">
            <div class="row">
                @foreach ($album->items as $item)
                    <div class="col-12 col-md-6 col-lg-{{ $column }} mb-3">
                        <a href="{{ $item->link }}">
                            <img class="img-fluid w-100 mb-2" src="{{ get_image($item->image) }}" alt="{{ $item->name }}">
                        </a>
                        <p class="fw-semibold text-center fs-4">
                            <a href="{{ $item->link }}" class="link-custom">{{ $item->name }}</a>
                        </p>
                        <div>
                            {!! htmlspecialchars_decode($item->description) !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
