@extends('backend.layouts.master')
@php
    $lc = app()->getLocale();
    if (isset($campaign)) {
        extract($campaign->getAttributes());
        if ($gallery) {
            $gallery = unserialize($gallery);
        }
    }

    $title_head = $name ?? __('Add campaign');
    $id = $id ?? 0;

    if (request()->route()->named('admin.campaign.create')) {
        $form_action = route('admin.campaign.store'); // Create news
    } else {
        $form_action = route('admin.campaign.update', $id); // Update news
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
            <form action="{{ $form_action }}" method="POST" id="frm-create-post" enctype="multipart/form-data">
                @if (!request()->route()->named('admin.campaign.create'))
                    @method('PUT')
                @endif
                @csrf
                <input type="hidden" name="id" value="{{ $id ?? 0 }}">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ $title_head }}</h4>
                            </div>
                            <div class="card-body">
                                {{-- show error form --}}
                                <div class="errorTxt"></div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ $slug ?? '' }}">
                                    @if ($id > 0)
                                        <p>
                                            <strong class="text-primary">Link VI:</strong>
                                            <u><i><a style="color: #F00;" href="{{ route('campaign.detail', [$slug, $id]) }}" target="_blank">{{ route('campaign.detail', [$slug, $id]) }}</a></i></u>
                                        </p>
                                        <p>
                                            <strong class="text-primary">Link EN:</strong>
                                            <u><i><a href="{{ route('campaign.detail', [$slug, $id], true, 'en') }}" target="_blank" class="text-red">{{ route('campaign.detail', [$slug, $id], true, 'en') }}</a></i></u>
                                        </p>
                                    @endif
                                </div>
                                <ul class="nav nav-tabs mb-3" id="nav-tab tabLang" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="vi-tab" data-bs-toggle="tab" href="#vi" role="tab" aria-controls="vi" aria-selected="true">@lang('admin.Vietnamese')</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="en-tab" data-bs-toggle="tab" href="#en" role="tab" aria-controls="en" aria-selected="false">@lang('admin.English')</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="vi" role="tabpanel" aria-labelledby="vi-tab">
                                        <div class="form-group">
                                            <label for="name">@lang('admin.Name')</label>
                                            <input type="text" class="form-control title_slugify" id="name" name="name" placeholder="@lang('admin.Title')" value="{{ $name ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">@lang('admin.Description')</label>
                                            <textarea id="description" name="description">{!! $description ?? '' !!}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="content" class="form-label">@lang('admin.Content')</label>
                                            <textarea id="content" name="content">{!! $content ?? '' !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                                        <div class="form-group">
                                            <label for="name_en" class="form-label">@lang('admin.Name')</label>
                                            <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Title" value="{{ $name_en ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description_en" class="form-label">@lang('admin.Description')</label>
                                            <textarea id="description_en" name="description_en">{!! $description_en ?? '' !!}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="content_en" class="form-label">@lang('admin.Content')</label>
                                            <textarea id="content_en" name="content_en">{!! $content_en ?? '' !!}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="note" class="form-label">@lang('admin.bank note')</label>
                                        <input type="text" class="form-control" id="note" name="note" placeholder="@lang('admin.bank note')" value="{{ $note ?? '' }}">
                                    </div>
                                </div>
                            </div> <!-- /.card-body -->
                        </div><!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <h5>@lang('Infomation')</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="sort" class="col-form-label text-lg-right">@lang('admin.Priority')</label>
                                    <input type="text" class="form-control" id="sort" name="sort" value="{{ $sort ?? 0 }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        @include('backend.partials.action_button')

                        {{-- SELECT CATEGORY --}}
                        <div class="card widget-category">
                            <div class="card-header">
                                <h4>@lang('admin.Category')</h4>
                            </div>
                            <div class="card-body max-vh-75">
                                <div class="inside clear">
                                    @php
                                        $array_checked = isset($campaign) ? $campaign->categories->pluck('id')->toArray() : [];
                                        $category_type = 'post';

                                        // dd($array_checked);

                                    @endphp
                                    @include('backend.partials.category-item')
                                </div>
                            </div>
                        </div>
                        {{-- END SELECT CATEGORY --}}

                        @include('backend.partials.image', ['title' => __('admin.Thumbnail'), 'id' => 'image', 'name' => 'image', 'image' => $image ?? ''])
                        @include('backend.partials.pdf', ['title' => __('admin.profile'), 'id' => 'profile', 'name' => 'profile', 'image' => $profile ?? ''])
                    </div>
                </div> <!-- /.row -->

                {{-- SEO --}}
                <div class="row">
                    <div class="col-12 col-md-9">
                        @include('backend.partials.form-seo')
                    </div>
                </div>
                {{-- END SEO --}}
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
