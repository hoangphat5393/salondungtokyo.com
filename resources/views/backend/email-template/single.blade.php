@extends('backend.layouts.master')

@php
    $lc = app()->getLocale();
    if (isset($emailTemplate)) {
        extract($emailTemplate->getAttributes());
    } else {
        $title_head = 'Add new email template';
    }

    $title_head = $name ?? '';

    $date_update = $updated_at ?? date('Y-m-d H:i:s');

    if (request()->route()->named('admin.email-template.create')) {
        $form_action = route('admin.email-template.store'); // Create news
    } else {
        $form_action = route('admin.email-template.update', $id); // Update news
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
            <form action="{{ $form_action }}" method="POST" id="frm-create-post" enctype="multipart/form-data">
                @if (!request()->route()->named('admin.email-template.create'))
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

                                {{-- <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="en-tab" data-toggle="pill" data-target="#pills-en" type="button" role="tab" aria-controls="pills-home" aria-selected="true">{{ trans('admin.English') }}</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="vi-tab" data-toggle="pill" data-target="#pills-vi" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">{{ trans('admin.Vietnamese') }}</button>
                                    </li>
                                </ul> --}}

                                <div class="tab-content">

                                    <div class="tab-pane fade active show" id="pills-vi" role="tabpanel" aria-labelledby="vi-tab">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tiêu đề</label>
                                            <input type="text" class="form-control title_slugify" id="name" name="name" placeholder="Tiêu đề" value="{{ $name ?? '' }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="code" class="form-label">Code</label>
                                            <input type="text" class="form-control" id="code" name="code" placeholder="Code" value="{{ $code ?? '' }}">
                                        </div>

                                        {{-- @php
                                            dd($arrayGroup, $group);
                                        @endphp --}}
                                        <div class="mb-3">
                                            <label for="group" class="form-label">Group</label>
                                            <select class="form-control group select2" name="group">
                                                <option value="">Select group</option>
                                                @foreach ($arrayGroup as $k => $v)
                                                    <option value="{{ $k }}" {{ isset($group) && $group == $k ? 'selected' : '' }}>{{ $v }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @php
                                            $content_arr = ['id' => 'text', 'label' => 'Nội dung mail', 'name' => 'text', 'content' => $text ?? ''];
                                        @endphp
                                        @include('backend.partials.content', $content_arr)
                                    </div>

                                    {{-- <div class="tab-pane fade show " id="pills-en" role="tabpanel" aria-labelledby="en-tab">
                                        <div class="form-group">
                                            <label for="name_en">Title</label>
                                            <input type="text" class="form-control title_slugify" id="name_en" name="name_en" placeholder="Title" value="{{ $name_en ?? '' }}">
                                        </div>
                                        @php
                                            $content_arr = ['id' => 'text_en', 'label' => 'Email content', 'name' => 'text_en', 'content' => $text_en ?? ''];
                                        @endphp
                                        @include('backend.partials.content', $content_arr)
                                    </div> --}}
                                </div>

                            </div>
                        </div>
                        {{-- end::card --}}
                    </div>
                    <div class="col-3">
                        @include('backend.partials.action_button')
                    </div>
                    {{-- end::row --}}

                </div>
            </form>
        </div>
    </div>
    {{-- end::App Content --}}
@endsection


@push('scripts')
    <script>
        // editor('text_en');
        editor('text');

        $(function() {
            //xử lý validate
            $("#frm-create-post").validate({
                ignore: [],
                rules: {
                    name_en: "required",
                    name: "required",
                    group: "required",
                },
                messages: {
                    name_en: "Enter mail title (EN)",
                    name: "Enter mail title (VN)",
                    group: "Select group"
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
