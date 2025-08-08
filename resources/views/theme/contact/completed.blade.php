@extends($templatePath . '.layouts.index')

@section('seo')
@endsection

@section('content')
    @include('theme.layouts.menu')
    <main id="contact_complete" class="main">
        <!-- Page Header Start -->

        <div class="container-fluid page-header py-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container text-center">
                <h4 class="animated slideInDown mb-3 fw-bold">@lang('Contact completed')</h4>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">@lang('Home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('Contact completed')</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Contact Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-7">
                        <div class="attention-info mb-3">
                            @if (session('contact_name'))
                                <h6>@lang('Dear') {{ session('contact_name') }}.</h6>
                            @endif
                            {{-- @if (App::getLocale() == 'vi')
                                {!! htmlspecialchars_decode(setting_option('Contact_completed_vi')) !!}
                            @else
                                {!! htmlspecialchars_decode(setting_option('Contact_completed')) !!}
                            @endif --}}
                            <p class="text-center">Thông tin liên hệ đã được gửi</p>
                        </div>
                        <div class="return-btn text-center">
                            <a href="{{ route('index') }}" class="btn btn-custom">@lang('Return home')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->
    </main>
@endsection
