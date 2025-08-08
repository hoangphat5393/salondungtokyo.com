@extends('backend.layouts.master')
@php
    if (isset($contact)) {
        extract($contact->toArray());
    } else {
        $title_head = 'Add new recruitment';
    }

    $title_head = $name ?? '';

    $id = $id ?? 0;

    $date_update = $updated_at ?? date('Y-m-d H:i:s');

    // if (request()->route()->named('admin.recruitment.create')) {
    //     $form_action = route('admin.recruitment.store'); // Create news
    // } else {
    //     $form_action = route('admin.recruitment.update', $id); // Update news
    // }

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
            {{-- <form action="{{ $form_action }}" method="POST" id="frm-create-post" enctype="multipart/form-data">
                @if (!request()->route()->named('admin.recruitment.create'))
                    @method('PUT')
                @endif
                @csrf --}}
            {{-- <input type="hidden" name="id" value="{{ $id ?? 0 }}"> --}}

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

                            {{-- <ul class="nav nav-tabs hidden" id="tabLang" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="vi-tab" data-toggle="tab" href="#vi" role="tab" aria-controls="vi" aria-selected="true">Tiếng việt</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="en-tab" data-toggle="tab" href="#en" role="tab" aria-controls="en" aria-selected="false">Tiếng Anh</a>
                                </li>
                            </ul> --}}

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="vi" role="tabpanel" aria-labelledby="vi-tab">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Tiêu đề</label>
                                        <input type="text" class="form-control title_slugify" id="name" name="name" placeholder="Tiêu đề" value="{{ $name ?? '' }}" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sort" class="form-label">Email</label>
                                        <input type="text" name="email" id="email" value="{{ $email ?? '' }}" class="form-control" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sort" class="form-label">Điện thoại</label>
                                        <input type="text" name="phone" id="phone" value="{{ $phone ?? 0 }}" class="form-control" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="content" class="form-label">Nội dung</label>
                                        <textarea id="content" name="content" disabled>{!! $content ?? '' !!}</textarea>
                                    </div>
                                </div>
                                {{-- <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                                        <div class="form-group">
                                            <label for="name_en">Title</label>
                                            <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Title" value="{{ $name_en ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description_en">Description</label>
                                            <textarea id="description_en" name="description_en">{!! $description_en ?? '' !!}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="content_en">Content</label>
                                            <textarea id="content_en" name="content_en">{!! $content_en ?? '' !!}</textarea>
                                        </div>
                                    </div> --}}
                            </div>

                            <div class="mb-3">
                                <label for="sort" class="form-label">Sắp xếp (Tăng dần)</label>
                                <input type="text" name="sort" id="sort" value="{{ $sort ?? 0 }}" class="form-control">
                            </div>

                        </div> <!-- /.card-body -->
                    </div><!-- /.card -->

                </div> <!-- /.col-9 -->

                <div class="col-md-3">
                    {{-- @include('backend.partials.action_button') --}}

                    {{-- @include('backend.partials.image', ['title' => 'Hình ảnh', 'id' => 'img', 'name' => 'image', 'image' => $image ?? '']) --}}
                    {{-- @include('backend.partials.image', ['title' => 'Hình ảnh Banner', 'id' => 'cover-img', 'name' => 'cover', 'image' => $cover ?? '']) --}}
                </div>
            </div>
            {{-- </form> --}}
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {
            // $('.slug_slugify').slugify('.title_slugify');

            editor('content');

            $('#thumbnail_file').change(function(evt) {
                $("#thumbnail_file_link").val($(this).val());
                $("#thumbnail_file_link").attr("value", $(this).val());
            });

            //xử lý validate
            $("#frm-create-post").validate({
                rules: {
                    name: "required",
                    'category[]': {
                        required: true,
                        minlength: 1
                    }
                },
                messages: {
                    name: "Nhập tiêu đề tin",
                    'category[]': "Chọn thể loại tin",
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
