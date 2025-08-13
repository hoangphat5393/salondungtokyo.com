@php extract($data); @endphp

@extends($templatePath . '.layouts.index')

@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection

@section('content')
    <main id="about">
        {{-- Page content --}}
        {{-- <section class="block8">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="category-title">{{ $page->title }}</h1>
                    </div>
                </div>
            </div>
            <div class="container">
                {!! htmlspecialchars_decode($page->content) !!}
            </div>
        </section> --}}

        @if ($page->content)
            {!! htmlspecialchars_decode($page->content) !!}
        @else
            <p class="text-center fs-3 my-4">@lang('The content is being updated')</p>
        @endif

        {{-- Subscribe --}}
        {{-- @include('theme.includes.subscribe') --}}
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
