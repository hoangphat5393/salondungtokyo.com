@extends('theme.layouts.index')

@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection

@section('body-class', 'blog')

@php
    use Carbon\Carbon;
    Carbon::setLocale('vi');
@endphp

@section('content')

    @include('theme.layouts.menu')

    <main id="news">
        <section class="block6">

            <div class="container-lg py-5">

                <div class="row row-cols-1 row-cols-md-2 align-items-center py-4">
                    <div class="col">
                        <h2 class="sec_h">@lang('News')<sup>{{ $news->count() }}</sup></h2>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-lg-2 align-items-center mb-5">
                    <div class="col">
                        <a href="{{ route('news.detail', ['slug' => $news->first()->slug, 'id' => $news->first()->id]) }}">
                            <figure class="">
                                <img src="{{ $news->first()->image }}" class="w-100 d-block mx-auto" alt="{{ $news->first()->name }}">
                            </figure>
                        </a>
                    </div>
                    <div class="col">
                        @php $cdt = new Carbon($news->first()->created_at);@endphp
                        <p class="text-end mb-2 fs-4">{{ $cdt->format('d-m-Y') }}</p>
                        <h2 class="mb-3 mb-lg-4">
                            <a href="{{ route('news.detail', ['slug' => $news->first()->slug, 'id' => $news->first()->id]) }}">
                                {{ $news->first()->name }}
                            </a>
                        </h2>
                        <div class="">
                            {!! htmlspecialchars_decode($news->first()->description) !!}
                        </div>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-2 g-3">
                    @foreach ($news->splice(2) as $item)
                        <div class="col">
                            <div class="row">
                                @php $cdt = new Carbon($item->created_at);@endphp
                                <div class="col">
                                    <a href="{{ route('news.detail', ['slug' => $item->slug, 'id' => $item->id]) }}">
                                        <figure class="">
                                            <img src="{{ $item->image }}" class="w-100 d-block mx-auto" alt="{{ $item->name }}">
                                        </figure>
                                    </a>
                                </div>

                                <div class="col">
                                    <h2 class="mb-3 mb-lg-3 fs-5">
                                        <p class="text-end mb-2">{{ $cdt->format('d-m-Y') }}</p>
                                        <a href="{{ route('news.detail', ['slug' => $item->slug, 'id' => $item->id]) }}">
                                            {{ $item->name }}
                                        </a>
                                    </h2>
                                    {{-- <div>
                                        {!! htmlspecialchars_decode($item->description) !!}
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


                {{-- <div class="row row-cols-md-2 row-cols-lg-3">
                    @foreach ($news->splice(2) as $item)
                        @php $cdt = new Carbon($item->created_at);@endphp

                        <div class="col mb-4">
                            <div class="item-news h-100">
                                <a href="{{ route('news.detail', ['slug' => $item->slug, 'id' => $item->id]) }}" class="link-custom">
                                    <figure class="img-res rounded-0">
                                        <img src="{{ $item->image }}" class="img-fluid d-block mx-auto" alt="{{ $item->name }}">
                                    </figure>
                                    <div class="news-content">
                                        <div class="news-meta d-flex mb-2">
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
                </div> --}}

            </div>
        </section>

        {{-- Subscribe --}}
        {{-- @include('theme.includes.subscribe') --}}
    </main>

@endsection
