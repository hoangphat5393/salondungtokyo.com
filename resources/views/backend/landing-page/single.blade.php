@extends('backend.layouts.master')
@php
    $lc = app()->getLocale();
    if (isset($landing_page)) {
        extract($landing_page->getAttributes());
    } else {
        $title_head = 'Add new landing page';
    }

    $title_head = $name ?? '';
    $template = $template ?? 'page';

    $id = $id ?? 0;

    if (request()->route()->named('admin.landing-page.create')) {
        $form_action = route('admin.landing-page.store'); // Create news
    } else {
        $form_action = route('admin.landing-page.update', $id); // Update news
    }
@endphp

@section('seo')
    @php
        $seo = [
            'title' => $title_head,
            'keywords' => '',
            'description' => '',
            'og_title' => $title_head,
            'og_description' => '',
            'og_url' => Request::url(),
            'og_img' => asset('images/logo_seo.png'),
            'current_url' => Request::url(),
            'current_url_amp' => '',
        ];
    @endphp
    @include('backend.partials.seo')
@endsection

@section('content')
    {{-- begin::App Content Header --}}
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">{{ $title_head }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title_head }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{-- end::App Content Header --}}

    {{-- begin::App Content --}}
    <div class="app-content">
        <div class="container-fluid">
            <form action="{{ $form_action }}" method="POST" id="frm-create-page" enctype="multipart/form-data">
                @if (!request()->route()->named('admin.landing-page.create'))
                    @method('PUT')
                @endif
                @csrf
                <input type="hidden" name="id" value="{{ $id ?? 0 }}">
                <div class="row">
                    <div class="col-md-9">

                        {{-- card --}}
                        <div class="card card-primary card-outline mb-4">

                            {{-- header --}}
                            <div class="card-header">
                                <h3 class="card-title">{{ $title_head }}</h3>
                            </div>

                            <div class="card-body">

                                {{-- show error form --}}
                                <div class="errorTxt"></div>

                                <div class="mb-3">
                                    <label for="slug" class="form-label">@lang('admin.Slug')</label>
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ $slug ?? '' }}">
                                    @if ($id > 0)
                                        <p class="my-2">
                                            <strong class="text-primary">Link Vi:</strong>
                                            <u><i><a href="{{ route('page', $slug) }}" target="_blank" class="text-red">{{ route('page', $slug) }}</a></i></u>
                                        </p>
                                        <p>
                                            <strong class="text-primary">Link EN:</strong>
                                            <u><i><a href="{{ route('page', $slug, true, 'en') }}" target="_blank" class="text-red">{{ route('page', $slug, true, 'en') }}</a></i></u>
                                        </p>
                                    @endif
                                </div>
                                <ul class="nav nav-tabs" id="nav-tab tabLang" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="vi-tab" data-bs-toggle="tab" href="#vi" role="tab" aria-controls="vi" aria-selected="true">@lang('admin.Vietnamese')</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="en-tab" data-bs-toggle="tab" href="#en" role="tab" aria-controls="en" aria-selected="false">@lang('admin.English')</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="vi" role="tabpanel" aria-labelledby="vi-tab">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">@lang('admin.Title')</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Name VI" value="{{ $name ?? '' }}">
                                        </div>
                                        @php
                                            $quote_arr = ['id' => 'description', 'label' => 'Description', 'name' => 'description', 'description' => $description ?? ''];
                                            $content_arr = ['id' => 'content', 'label' => __('admin.Content'), 'name' => 'content', 'content' => $content ?? ''];
                                        @endphp
                                        @include('backend.partials.quote', $quote_arr)
                                        @include('backend.partials.content', $content_arr)
                                    </div>
                                    <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                                        <div class="mb-3">
                                            <label for="name_en" class="form-label">@lang('admin.Title')</label>
                                            <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Name EN" value="{{ $name_en ?? '' }}">
                                        </div>
                                        @php
                                            $quote_arr = ['id' => 'description_en', 'label' => 'Description', 'name' => 'description_en', 'description' => $description_en ?? ''];
                                            $content_arr = ['id' => 'content_en', 'label' => __('admin.Content'), 'name' => 'content_en', 'content' => $content_en ?? ''];
                                        @endphp
                                        @include('backend.partials.quote', $quote_arr)
                                        @include('backend.partials.content', $content_arr)
                                    </div>
                                </div>

                                {{-- @php
                                    $content_arr = ['id' => 'footer', 'label' => __('admin.Footer'), 'name' => 'footer', 'content' => $footer ?? ''];
                                @endphp --}}
                                {{-- @include('backend.partials.content', $content_arr) --}}

                                {{-- <div class="mb-3">
                                    <label for="show_promotion" class="title_txt">Template</label>
                                    <select name="template" class="form-control">
                                        <option value="none" {{ $template == 'none' ? 'selected' : '' }}>@lang('admin.None')</option>
                                        <option value="page" {{ $template == 'page' ? 'selected' : '' }}>@lang('admin.Page')</option>
                                    </select>
                                </div> --}}
                            </div>
                        </div>
                        {{-- end::card --}}
                    </div>

                    <div class="col-md-3">
                        @include('backend.partials.action_button')
                        @include('backend.partials.image', ['title' => 'Banner', 'id' => 'img', 'name' => 'image', 'image' => $image ?? ''])
                        {{-- @include('backend.partials.image', ['title' => 'Hình ảnh Banner', 'id' => 'cover-img', 'name' => 'cover', 'image' => $cover]) --}}
                    </div>
                </div>
                {{-- end::row --}}

                {{-- SEO --}}
                <div class="row">
                    <div class="col-12 col-md-9">
                        @include('backend.partials.form-seo')
                    </div>
                </div>
                {{-- END SEO --}}
            </form>
        </div>
    </div>
    {{-- end::App Content --}}
@endsection

@push('scripts')
    <script type="text/javascript">
        editorQuote('description');
        editorQuote('description_en');

        editor('content');
        editor('content_en');

        // editor('footer');

        $(function() {
            // $('.slug_slugify').slugify('.title_slugify');
            //xử lý validate
            $("#frm-create-page").validate({
                rules: {
                    post_title: "required",
                },
                messages: {
                    post_title: "Nhập tiêu đề trang",
                },
                errorElement: 'div',
                errorLabelContainer: '.errorTxt',
                invalidHandler: function(event, validator) {
                    $('html, body').animate({
                        scrollTop: 0
                    }, 500);
                }
            });
        });
    </script>
@endpush
