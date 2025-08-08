@extends('backend.layouts.master')
@section('seo')
    @php
        $title_head = 'Donate';
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

                        {{-- header --}}
                        <div class="card-header">
                            <h3 class="card-title">{{ $title_head }} List</h3>
                        </div>

                        <div class="card-body">

                            <div class="d-flex flex-column flex-lg-row justify-content-between">
                                @include('backend.partials.button_delete', ['type' => 'payment'])
                                <div>
                                    <form method="GET" action="" id="frm-filter-post" class="form-inline">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="id" name="id" placeholder="@lang('admin.id')" aria-label="@lang('admin.id')" aria-describedby="id" value="{{ request('id') }}">
                                            <button class="btn btn-outline-primary" type="submit" id="button-addon2">
                                                <i class="fa-regular fa-magnifying-glass"></i> @lang('admin.search')
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center my-4">
                                <div>
                                    <b>@lang('admin.total')</b>: <span class="fw-bold text-red">{{ $total_item ?? 0 }}</span> @lang('admin.order')
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
                                            <th scope="col" class="text-center" style="width:45px">#</th>
                                            <th class="text-center">Amount</th>
                                            <th class="text-center">@lang('admin.donors')</th>
                                            <th class="text-center">@lang('admin.camgpaign')</th>
                                            <th class="text-center">Pay type</th>
                                            <th class="text-center">Payment method</th>
                                            <th class="text-center">Session id</th>
                                            <th class="text-center">@lang('admin.created date')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td class="text-center">
                                                    <div class="icheck-info d-inline">
                                                        <input type="checkbox" id="{{ $item->id }}" name="seq_list[]" value="{{ $item->id }}">
                                                        <label for="{{ $item->id }}"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->id }}
                                                </td>
                                                <td>
                                                    <div class="text-red fw-bold">
                                                        {{ $item->amount }} {{ $item->currency }}
                                                    </div>
                                                    {{-- @if ($item->payment_onepay_request)
                                                        <p>
                                                            Transaction Number: {{ $item->payment_onepay_request->vpc_MerchTxnRef }}
                                                        </p>
                                                    @endif --}}
                                                </td>

                                                <td>
                                                    @if ($item->info)
                                                        <p>Name: {{ $item->info->lastname }} {{ $item->info->firstname }}</p>
                                                        <p>
                                                            Email: {{ $item->info->email }}
                                                            <br>
                                                            Phone: {{ $item->info->phone }}
                                                            <br>
                                                            Message: {{ $item->info->content }}
                                                        </p>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->info)
                                                        <div class="fw-bold">
                                                            {{ $item->info->post->name }}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->pay_type }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->payment_method }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->session_id }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->updated_at }}
                                                    <br>
                                                    <input type="checkbox" id="status" class="quick_change_value" @checked($item->status == 1) value="1" value-off="0" data-id="{{ $item->id }}" data-model="{{ get_class($item) }}" data-toggle="toggle" data-on="@lang('admin.Success')" data-off="@lang('admin.Pending')" data-onstyle="success" data-offstyle="light" @disabled(true)>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        {{-- card-footer --}}
                        {{ $data->links('backend.pagination.custom') }}

                    </div>
                    {{-- end::card --}}
                </div>
            </div>
            {{-- end::Row --}}
        </div>
    </div>
    {{-- end::App Content --}}
@endsection

{{--
@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('.order-view-hide').click(function() {
                var id = $(this).data('id');
                $(this).hide();
                $(this).closest('tr').find('.order-view-detail').show();
                $('.parent-id-' + id).hide();
            });
            $('.order-view-detail').click(function() {
                var id = $(this).data('id')
                $(this).hide();
                $('.parent-id-' + id).show();
                $(this).closest('tr').find('.order-view-hide').show();
            });
        });
    </script>
@endpush --}}
