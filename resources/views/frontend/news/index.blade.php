@extends('frontend.layouts.master')

@section('content')
<section class="py-5 bg-dark text-white text-center" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset('upload/images/banner_hero.jpg') }}') center/cover;">
    <div class="container py-4">
        <h1 class="display-4 fw-bold font-heading text-warning mb-2">XU HƯỚNG TÓC & TIN TỨC</h1>
        <p class="lead text-light mb-0">Cập nhật các mẫu tóc thịnh hành và bí quyết chăm sóc mái tóc khỏe đẹp tại nhà</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container py-3">
        <div class="row g-4">
            @forelse($news ?? $posts ?? [] as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                        <div style="height: 220px;" class="overflow-hidden">
                            <img src="{{ get_image($item->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $item->name }}">
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <small class="text-warning fw-bold mb-2"><i class="bi bi-calendar3 me-1"></i> {{ $item->created_at ? $item->created_at->format('d/m/Y') : '' }}</small>
                            <h5 class="card-title font-heading fw-bold text-dark mb-2">
                                <a href="{{ route('news.detail', ['slug' => $item->slug, 'id' => $item->id]) }}" class="text-decoration-none text-dark hover-gold">
                                    {{ $item->name }}
                                </a>
                            </h5>
                            <p class="card-text text-muted small flex-grow-1">
                                {{ Str::limit(strip_tags($item->description ?: $item->content), 120) }}
                            </p>
                            <a href="{{ route('news.detail', ['slug' => $item->slug, 'id' => $item->id]) }}" class="btn btn-outline-gold btn-sm mt-2">
                                Đọc chi tiết <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-muted">
                    <i class="bi bi-newspaper fs-1 text-warning d-block mb-3"></i>
                    <h4>Đang cập nhật các bài viết mới!</h4>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
