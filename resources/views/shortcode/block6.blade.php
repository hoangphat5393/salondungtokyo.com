@php
    use Carbon\Carbon;
    Carbon::setLocale('vi');
@endphp

@empty(!$news)
    <section class="block6">
        <div class="container py-5">
            <div class="d-flex align-items-center justify-content-between py-4">
                <div class="col">
                    <h2 class="sec_h mb-0">@lang('News')<sup>{{ $news->count() }}</sup></h2>
                </div>
                <div class="col text-end">
                    <a href="{{ route('news') }}" class="btn btn-custom">@lang('All news')</a>
                </div>
            </div>

            <div class="row row-cols-md-2 row-cols-lg-3">
                @foreach ($news as $item)
                    @php $cdt = new Carbon($item->created_at);@endphp
                    <div class="col mb-4">
                        <div class="item-news h-100">
                            <a href="{{ route('news.detail', ['slug' => $item->slug, 'id' => $item->id]) }}" class="link-custom">
                                <figure class="img-res rounded-0">
                                    <img src="{{ $item->image }}" class="img-fluid d-block mx-auto" alt="{{ $item->name }}">
                                </figure>
                                <div class="news-content">
                                    <div class="news-meta d-flex mb-2">
                                        {{-- <div class="cate-tag">Hoạt động</div> --}}
                                        <div class="news-date">
                                            <i class="fa-sharp fa-solid fa-circle fa-sm"></i>
                                            @if (app()->getLocale() == 'vi')
                                                {{ $cdt->format('d-m-Y') }}
                                            @else
                                                {{ $cdt->format('d-M-Y') }}
                                            @endif
                                        </div>
                                    </div>
                                    <h4 class="news-title text-truncate">{{ $item->name }}</h4>
                                    <div class="news-description">
                                        {!! htmlspecialchars_decode($item->description) !!}
                                    </div>
                                    <div class="text-end">
                                        <a href="{{ route('news.detail', ['slug' => $item->slug, 'id' => $item->id]) }}" class="read-more">Xem chi tiết</a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endempty
