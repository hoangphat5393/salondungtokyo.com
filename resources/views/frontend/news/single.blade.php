@extends('theme.layouts.index')

@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection

{{-- @section('body-class', 'single') --}}

@php
    use Carbon\Carbon;
    Carbon::setLocale('vi');
    $lc = app()->getLocale();
@endphp

@section('content')
    @include('theme.layouts.menu')
    <main id="new_detail">

        <section class="block12 py-5">
            <div class="container bg-white rounded">
                <div class="row justify-content-center">
                    <div class="col">
                        <img class="img-fluid object-fit-cover d-block mx-auto my-4" src="{{ get_image($news->image) }}" alt="{{ $news->name }}">
                        @empty(!$news)
                            {!! htmlspecialchars_decode($news->content) !!}
                        @endempty
                    </div>
                </div>
            </div>
        </section>

        {{-- Subscribe --}}
        {{-- @include('theme.includes.subscribe') --}}
    </main>
@endsection


@push('scripts')
    {{-- <script>
        (function() {
            window.mc4wp = window.mc4wp || {
                listeners: [],
                forms: {
                    on: function(evt, cb) {
                        window.mc4wp.listeners.push({
                            event: evt,
                            callback: cb
                        });
                    }
                }
            }
        })();
    </script> --}}
@endpush
