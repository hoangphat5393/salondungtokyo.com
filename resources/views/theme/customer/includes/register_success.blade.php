@php
    use Carbon\Carbon;
    Carbon::setLocale('vi');
    $lc = app()->getLocale();

    // $category_product = Menu::getByName('Categories-product-home');

@endphp

@extends($templatePath . '.layouts.index')

@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection

@section('content')
    <main id="main">

        [menu_no_banner]

        <div class="content_group_offer_view pb-3 text-center d-flex align-items-center justify-content-center" style="height:40vh">
            <div>
                {{-- <p><img src="{{ asset('images/circle-icon.png') }}"></p> --}}
                <p>Đăng ký tài khoản của bạn đã thành công</p>
                <p>Bạn sẽ được thông báo về tình trạng đăng ký của mình qua e-mail</p>
                <p>@lang('Back') <a href="{{ route('index') }}" style="color: rgb(255 153 51);">@lang('Home')</a></p>
            </div>
        </div>

    </main>
@endsection

@push('scripts')
    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     const el = document.querySelector('.counter');
        //     // Tiếp tục xử lý tại đây...
        // });
    </script>
@endpush
