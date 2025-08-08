@php
    $parent = $parent ?? '0';
@endphp
@if (count($data) > 0)
    @foreach ($data as $item)
        <tr>
            <td class="text-center">
                <div class="icheck-info d-inline">
                    <input type="checkbox" id="{{ $item->id }}" name="seq_list[]" value="{{ $item->id }}">
                    <label for="{{ $item->id }}"></label>
                </div>
            </td>
            <td class="text-center">
                <input type="text" id="sort" class="form-control quick_change_value text-center" data-id="{{ $item->id }}" data-model="{{ get_class($item) }}" value="{{ $item->sort }}" reload-on-change>
            </td>
            <td>
                <div class="text-red fw-bold">
                    {{ $item->amount }} {{ $item->currency }}
                </div>
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
                <input type="checkbox" id="status" class="quick_change_value" @checked($item->status == 1) value="1" value-off="0" data-id="{{ $item->id }}" data-model="{{ get_class($item) }}" data-toggle="toggle" data-on="@lang('admin.Success')" data-off="@lang('admin.Pending')"
                    data-onstyle="success" data-offstyle="light" @disabled(true)>
            </td>
        </tr>
    @endforeach
@endif


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
@endpush
