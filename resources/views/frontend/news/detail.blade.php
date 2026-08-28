@extends('frontend.layouts.master')

@section('content')
<section class="py-4 bg-light border-bottom">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('index') }}" class="text-decoration-none text-dark">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('news') }}" class="text-decoration-none text-dark">Tin tức</a></li>
                <li class="breadcrumb-item active text-warning" aria-current="page">{{ $post->name ?? 'Chi tiết bài viết' }}</li>
            </ol>
        </nav>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <article>
                    <h1 class="display-5 font-heading fw-bold text-dark mb-3">{{ $post->name ?? '' }}</h1>
                    <div class="d-flex align-items-center gap-3 text-muted small mb-4 pb-3 border-bottom">
                        <span><i class="bi bi-calendar3 me-1 text-warning"></i> {{ $post->created_at ? $post->created_at->format('d/m/Y H:i') : '' }}</span>
                        <span><i class="bi bi-person me-1 text-warning"></i> Salon Dũng Tokyo</span>
                    </div>

                    @if(!empty($post->image))
                        <div class="mb-4 text-center">
                            <img src="{{ get_image($post->image) }}" class="img-fluid rounded-4 shadow-sm" alt="{{ $post->name }}">
                        </div>
                    @endif

                    @if(!empty($post->description))
                        <div class="lead fw-semibold text-dark mb-4 p-3 bg-light rounded-3 border-start border-4 border-warning">
                            {!! $post->description !!}
                        </div>
                    @endif

                    <div class="content text-dark lh-lg fs-5">
                        {!! $post->content ?? '' !!}
                    </div>

                    <div class="mt-5 p-4 rounded-4 text-center" style="background: linear-gradient(135deg, #1f2127, #121316); color: white;">
                        <h4 class="font-heading text-warning mb-2">Bạn muốn sở hữu kiểu tóc thời thượng này?</h4>
                        <p class="text-light-50 mb-3">Đặt lịch hẹn ngay hôm nay để nhận tư vấn trực tiếp từ Master Stylist Salon Dũng Tokyo!</p>
                        <a href="{{ route('index') }}#booking-section" class="btn btn-gold btn-lg px-4">
                            <i class="bi bi-calendar-check me-2"></i> ĐẶT LỊCH LÀM TÓC
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
@endsection
