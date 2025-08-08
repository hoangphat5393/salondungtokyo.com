@extends($templatePath . '.layouts.index')

@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection


@section('content')
    @include('theme.layouts.menu')
    <main id="about">

        {{-- block1 --}}
        [block_about]

        {{-- block7 --}}
        [block_vision]

        {{-- Partner (block5) --}}
        @include('theme.includes.partner')

    </main>
@endsection


@push('scripts')
    {{-- <script>
        var main_splide = new Splide('.main-splide', {
            arrows: false,
            gap: '1.25rem',
            pagination: true,
            arrows: false
        });
        main_splide.mount();
    </script> --}}
@endpush
