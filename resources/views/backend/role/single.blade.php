@extends('backend.layouts.master')
@php
    $lc = app()->getLocale();
    if (isset($role)) {
        extract($role->getAttributes());
    }

    $title_head = $name ?? __('add role');
    $id = $id ?? 0;

    if (request()->route()->named('admin.role.create')) {
        $form_action = route('admin.role.store'); // Create news
    } else {
        $form_action = route('admin.role.update', $id); // Update news
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

            <form id="formEdit" action="{{ $form_action }}" method="POST" enctype="multipart/form-data">
                @if (!request()->route()->named('admin.role.create'))
                    @method('PUT')
                @endif
                @csrf
                <input type="hidden" name="id" value="{{ $id ?? 0 }}">

                @if ($errors->any())
                    <div>
                        @foreach ($errors->all() as $error)
                            <p class="text-error">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div class="row">
                    <div class="col-9">

                        <div class="card card-primary card-outline mb-4">

                            {{-- header --}}
                            <div class="card-header">
                                <h3 class="card-title">{{ $title_head }}</h3>
                            </div>

                            <div class="card-body">
                                {{-- show error form --}}
                                <div class="errorTxt"></div>

                                @if ($errors->has('name'))
                                    <span class="form-text">
                                        <i class="fa fa-info-circle"></i> {{ $errors->first('name') }}
                                    </span>
                                @endif

                                {{-- <ul class="nav nav-tabs" id="tabLang" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="vi-tab" data-toggle="tab" href="#vi" role="tab" aria-controls="vi" aria-selected="true">@lang('admin.Vietnamese')</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="en-tab" data-toggle="tab" href="#en" role="tab" aria-controls="en" aria-selected="false">@lang('admin.English')</a>
                                    </li>
                                </ul> --}}

                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug" value="{{ $slug ?? '' }}">
                                </div>

                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="vi" role="tabpanel" aria-labelledby="vi-tab">
                                        <div class="mb-3">
                                            <label for="name">@lang('admin.name')</label>
                                            <input type="text" class="form-control title_slugify" id="name" name="name" value="{{ $name ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                                        <div class="form-group">
                                            <label for="name_en">@lang('admin.name')</label>
                                            <input type="text" class="form-control title_slugify" id="name_en" name="name_en" value="{{ $name_en ?? '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    @php
                                        $listPermission = [];
                                        if (isset($permission_selected) && is_array($permission_selected)) {
                                            foreach ($permission_selected as $value) {
                                                $listPermission[] = (int) $value;
                                            }
                                        }
                                    @endphp
                                    <label for="post_description">@lang('Permission')</label>
                                    <select name="permission[]" id="admin_level" class="form-control select2" multiple="multiple" onautocomplete="off">
                                        <option value=""></option>
                                        @foreach ($permission as $k => $v)
                                            <option value="{{ $k }}" {{ count($listPermission) && in_array($k, $listPermission) ? 'selected' : '' }}>{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        @include('backend.partials.action_button_no_status')
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- end::App Content --}}
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {
            //xử lý validate
            $("#formEdit").validate({
                rules: {
                    name: "required",
                },
                messages: {
                    name: "Vui lòng nhập tên",
                },
                // errorElement: 'div',
                // errorLabelContainer: '.errorTxt',
                invalidHandler: function(event, validator) {
                    $('html, body').animate({
                        scrollTop: 0
                    }, 500);
                }
            });
        });
    </script>
@endpush
