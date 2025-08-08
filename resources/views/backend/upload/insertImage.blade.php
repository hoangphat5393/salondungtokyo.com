@extends('backend.layouts.app')
@php
    $lc = app()->getLocale();
    if (isset($post)) {
        extract($post->getAttributes());
        if ($gallery) {
            $gallery = unserialize($gallery);
        }
    }

    $title_head = $name ?? __('Add news');
    $id = $id ?? 0;

    $form_action = route('admin.upload.saveImage'); // Update news
@endphp

@section('seo')
    @php
        $seo = [
            'title' => $title_head . ' | ' . Helpers::get_option_minhnn('seo-title-add'),
            'keywords' => Helpers::get_option_minhnn('seo-keywords-add'),
            'description' => Helpers::get_option_minhnn('seo-description-add'),
            'og_title' => 'Sản phẩm | ' . Helpers::get_option_minhnn('seo-title-add'),
            'og_description' => Helpers::get_option_minhnn('seo-description-add'),
            'og_url' => Request::url(),
            'og_img' => asset('images/logo_seo.png'),
            'current_url' => Request::url(),
            'current_url_amp' => '',
        ];
    @endphp
    @include('backend.partials.seo')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $title_head }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form id="formEdit" action="{{ $form_action }}" method="POST" enctype="multipart/form-data">
                {{-- @if (!request()->route()->named('admin.post.create'))
                    @method('PUT')
                @endif --}}
                @csrf
                <input type="hidden" name="id" value="{{ $id ?? 0 }}">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-capitalize">{{ $title_head }}</h3>
                            </div>
                            <div class="card-body">
                                {{-- show error form --}}
                                <div class="errorTxt"></div>

                                <div class="mb-3">
                                    <label for="basic-url" class="form-label">Your vanity URL</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon3">{{ url('/') }}/upload/images/case_study</span>
                                        <input type="text" class="form-control" id="basic-url" name="imageFolder">
                                    </div>
                                    <div class="form-text" id="basic-addon4">Example help text goes outside the input group.</div>
                                </div>

                                <div class="form-group">
                                    <label for="name">ID</label>
                                    <input type="text" class="form-control title_slugify" id="id" name="id" placeholder="@lang('admin.Title')" value="{{ $name ?? '' }}">
                                </div>

                            </div> <!-- /.card-body -->
                        </div><!-- /.card -->
                    </div>

                    <div class="col-md-3">
                        @include('admin.partials.action_button')

                        @include('admin.partials.image', ['title' => __('admin.Thumbnail'), 'id' => 'img', 'name' => 'image', 'image' => $image ?? ''])
                    </div>
                </div> <!-- /.row -->
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {
            // $('.slug_slugify').slugify('.title_slugify');

            editorQuote('description');
            editorQuote('description_en');
            editor('content');
            editor('content_en');

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
