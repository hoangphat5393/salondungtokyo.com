@extends('frontend.layouts.master')

@section('content')
<section class="py-4 bg-light border-bottom">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('index') }}" class="text-decoration-none text-dark">Trang chủ</a></li>
                <li class="breadcrumb-item active text-warning" aria-current="page">{{ $page->name ?? $page->title ?? 'Thông tin' }}</li>
            </ol>
        </nav>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <article>
                    <h1 class="display-5 font-heading fw-bold text-dark mb-4">{{ $page->name ?? $page->title ?? '' }}</h1>

                    @if(!empty($page->image))
                        <div class="mb-4 text-center">
                            <img src="{{ get_image($page->image) }}" class="img-fluid rounded-4 shadow-sm" alt="{{ $page->name }}">
                        </div>
                    @endif

                    <div class="content text-dark lh-lg fs-5">
                        {!! $page->content ?? '' !!}
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
@endsection
