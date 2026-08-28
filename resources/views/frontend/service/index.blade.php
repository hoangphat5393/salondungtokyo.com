@extends('frontend.layouts.master')

@section('content')
<!-- Page Banner -->
<section class="py-5 bg-dark text-white text-center position-relative" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset('upload/images/banner_hero.jpg') }}') center/cover;">
    <div class="container py-4">
        <h1 class="display-4 fw-bold font-heading text-warning mb-2">DỊCH VỤ & BẢNG GIÁ</h1>
        <p class="lead text-light mb-0">Cam kết sử dụng 100% mỹ phẩm chính hãng & Kỹ thuật phục hồi tóc chuyên sâu</p>
    </div>
</section>

<!-- Service List -->
<section class="py-5 bg-light">
    <div class="container py-3">
        <div class="row g-4">
            @forelse($services ?? [] as $service)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="position-relative" style="height: 240px;">
                            <img src="{{ get_image($service->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $service->name }}">
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <h4 class="card-title font-heading fw-bold text-dark mb-2">{{ $service->name }}</h4>
                            <div class="card-text text-muted small flex-grow-1 mb-3">
                                {!! $service->description ?: Str::limit(strip_tags($service->content), 120) !!}
                            </div>
                            <a href="{{ route('index') }}#booking-section" class="btn btn-gold w-100 py-2">
                                <i class="bi bi-calendar-check me-1"></i> Đặt Lịch Dịch Vụ Này
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-muted">
                    <i class="bi bi-scissors fs-1 text-warning d-block mb-3"></i>
                    <h4>Đang cập nhật bảng giá dịch vụ mới!</h4>
                    <p>Quý khách vui lòng liên hệ trực tiếp hotline để được tư vấn giá tốt nhất.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
