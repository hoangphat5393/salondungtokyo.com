@extends('backend.layouts.master')
@section('seo')
    @php
        $title_head = __('admin.permissions');
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

            <div class="row">
                <div class="col-12">

                    {{-- card --}}
                    <div class="card card-primary card-outline mb-4">

                        {{-- card-header --}}
                        <div class="card-header">
                            <h3 class="card-title">List</h3>
                        </div>

                        <div class="card-body">
                            <div class="d-flex flex-column flex-lg-row align-items-center justify-content-between">
                                @include('backend.partials.button_add_delete', ['type' => 'permission', 'route' => route('admin.permission.create')])
                            </div>

                            <div class="d-flex align-items-center justify-content-between my-4">
                                <div>
                                    <b>@lang('admin.total')</b>: <span class="fw-bold text-red">{{ $total_item ?? 0 }}</span> @lang('admin.permissions')
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered list-data v-center" id="table_index">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width:50px">
                                                <div class="icheck-info d-inline">
                                                    <input type="checkbox" id="selectall" onclick="select_all()">
                                                    <label for="selectall"></label>
                                                </div>
                                            </th>
                                            <th scope="col">@lang('admin.name')</th>

                                            <th scope="col">Http path</th>
                                            <th scope="col" class="text-center">@lang('admin.action')</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($permissions as $data)
                                            <tr>
                                                <td class="text-center">
                                                    <div class="icheck-info d-inline">
                                                        <input type="checkbox" id="{{ $data->id }}" name="seq_list[]" value="{{ $data->id }}">
                                                        <label for="{{ $data->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.permission.edit', $data->id) }}" title="">{{ $data->name }}</a>
                                                </td>
                                                <td>
                                                    @php
                                                        $permissions = '';
                                                        if ($data->http_uri) {
                                                            $methods = array_map(function ($value) {
                                                                $route = explode('::', $value);
                                                                $methodStyle = '';
                                                                if ($route[0] == 'ANY') {
                                                                    $methodStyle = '<span class="badge text-bg-info">' . $route[0] . '</span>';
                                                                } elseif ($route[0] == 'POST') {
                                                                    $methodStyle = '<span class="badge text-bg-warning">' . $route[0] . '</span>';
                                                                } else {
                                                                    $methodStyle = '<span class="badge text-bg-primary">' . $route[0] . '</span>';
                                                                }
                                                                return $methodStyle . ' <code>' . $route[1] . '</code>';
                                                            }, explode(',', $data->http_uri));
                                                            $permissions = implode('<br>', $methods);
                                                        }
                                                    @endphp
                                                    {!! $permissions !!}
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.permission.edit', $data->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pen"></i> Edit</a><a href="" title=""></a>
                                                    {{-- <a href="{{ route('admin.permission.destroy', $data->id) }}" class="btn btn-danger btn-sm btn_deletes"><i class="fa fa-trash"></i> Remove</a><a href="" title=""></a> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- /.card-body -->
                    </div>
                    {{-- end::card --}}
                </div>
            </div>
            {{-- end::Row --}}
        </div>
    </div>
    {{-- end::App Content --}}
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('.btn_deletes').on('click', function() {
                if (confirm('Bạn có chắc muốn xóa tài khoản?')) {
                    return true;
                }
                return false;
            });

        });
    </script>
@endpush
