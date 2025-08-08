@extends('backend.layouts.master')
@section('seo')
    @php
        $title_head = __('admin.role');
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

            {{-- begin::Row --}}
            <div class="row">
                <div class="col-md-12">

                    {{-- card --}}
                    <div class="card card-primary card-outline mb-4">

                        {{-- card-header --}}
                        <div class="card-header">
                            <h3 class="card-title">List</h3>
                        </div>

                        <div class="card-body">
                            <div class="d-flex flex-column flex-lg-row justify-content-between">
                                @include('backend.partials.button_add_delete', ['type' => 'role', 'route' => route('admin.role.create')])
                                <div>
                                    <form method="GET" action="" id="frm-filter-post" class="form-inline">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="@lang('admin.name')" aria-label="@lang('admin.Keyword')" aria-describedby="name" value="{{ request('name') }}">
                                            <button class="btn btn-outline-primary" type="submit" id="button-addon2">
                                                <i class="fa-regular fa-magnifying-glass"></i> @lang('admin.search')
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between my-4">
                                <div>
                                    <b>@lang('admin.total')</b>: <span class="fw-bold text-red">{{ $total_item ?? 0 }}</span> @lang('admin.news')
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered list-data" id="table_index">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width:50px">
                                                <div class="icheck-info d-inline">
                                                    <input type="checkbox" id="selectall" onclick="select_all()">
                                                    <label for="selectall"></label>
                                                </div>
                                            </th>
                                            <th scope="col">@lang('admin.name')</th>
                                            <th scope="col">@lang('admin.slug')</th>
                                            <th scope="col" class="text-center">@lang('admin.permission')</th>
                                            <th scope="col" class="text-center">@lang('admin.action')</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($roles as $data)
                                            <tr class="align-middle">
                                                <td class="text-center">
                                                    <div class="icheck-info d-inline">
                                                        <input type="checkbox" id="{{ $data->id }}" name="seq_list[]" value="{{ $data->id }}">
                                                        <label for="{{ $data->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.role.edit', $data->id) }}" title="">{{ $data->name }} | {{ $data->name_en }}</a>
                                                </td>
                                                <td>{{ $data->slug }}</td>
                                                <td class="text-center">
                                                    {{-- @php
                                                        $showPermission = '';
                                                        if ($data->permissions->count()) {
                                                            foreach ($data->permissions as $key => $p) {
                                                                $showPermission .= '<span class="badge badge-success"">' . $p->name . '</span> ';
                                                            }
                                                        }
                                                    @endphp
                                                    {!! $showPermission !!} --}}
                                                    @if ($data->permissions->count())
                                                        @foreach ($data->permissions as $permissions)
                                                            <span class="badge text-bg-success">{{ $permissions->name }}</span>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.role.edit', $data->id) }}" class="btn btn-primary btn-sm">
                                                        <i class="fa fa-pen"></i> Edit</a><a href="" title="">
                                                    </a>
                                                    {{-- <a href="{{ route('admin.role.delete', $data->id) }}" class="btn btn-danger btn-sm btn_deletes"><i class="fa fa-trash"></i> Remove</a><a href="" title=""></a> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- card-footer --}}
                        {{ $roles->links('backend.pagination.custom') }}

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
    <script>
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
