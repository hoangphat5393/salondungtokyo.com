@extends('theme.layouts.empty')

@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection

{{-- @section('body-class', 'page-template-default page page-id-1940') --}}

@section('content')
    <main id="contact">

        <section>
            <div class="container-fluid">
                <img src="" alt="">
            </div>
        </section>

        {{-- Page content --}}
        {!! htmlspecialchars_decode($page->content) !!}

    </main>
@endsection

@push('scripts')
@endpush
