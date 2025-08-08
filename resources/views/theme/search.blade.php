@extends($templatePath . '.layouts.index')

@section('seo')
    <title>Search</title>
@endsection


@php
    use Carbon\Carbon;
    Carbon::setLocale('vi');
@endphp

@section('content')
    <main id="news_category">
        <section class="block1">
            @include('theme.includes.hero_section')
        </section>

        <section class="block8 mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="category-title">@lang('Search')</h1>
                        <p class="fs-4">Từ tìm kiếm: <strong>{{ $keyword ?? '' }}</strong></p>
                    </div>
                </div>

                @if ($news)
                    @foreach ($news as $item)
                        @php
                            $cdt = new Carbon($item->created_at);
                        @endphp

                        <div class="row article g-0 mb-5">
                            <div class="col-lg-4 article__img">
                                <div class="item-product">
                                    <a href="#" title="">
                                        <div class="product-img">
                                            <img src="{{ get_image($item->image) }}" class="img-fluid" alt="{{ $item->name }}">
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-8 article__desc">
                                <div class="datetime text-end my-3">
                                    <span>{{ $cdt->format('d-m-Y') }}</span>
                                </div>
                                <h4><a href="{{ route('news.detail', [$item->slug, $item->id]) }}" class="custom">{{ $item->name }}</a></h4>
                                {!! htmlspecialchars_decode($item->description) !!}
                            </div>
                        </div>
                    @endforeach

                    <div class="nav-pagination">
                        {!! $news->appends(request()->input())->links($templateFile . '.pagination.custom') !!}
                        {{-- {{ $news->links() }} --}}
                    </div>
                @else
                    <p>Không có bài viết nào</p>
                @endif

            </div>
        </section>

        {{-- Subscribe --}}
        @include('theme.includes.subscribe')
    </main>
@endsection
