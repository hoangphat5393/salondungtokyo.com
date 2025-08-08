@php
    $landing = \App\Models\Backend\Page::where(['status' => 1, 'type' => 'landing_page'])
        ->orderByDesc('sort')
        ->get();
@endphp

@if (count($landing) > 0)
    @foreach ($landing as $item)
        <div class="form-group">
            <label for="landing_{{ $item->id }}" class="">
                <input type="checkbox" class="landing_item_input" value="{{ $item->id }}" id="landing_{{ $item->id }}">
                {{ $item->name }}
                <input type="hidden" class="item-name-{{ $item->id }}" value="{{ $item->name }}">
                <input type="hidden" class="item-slug-{{ $item->id }}" value="{{ $item->slug }}">
                <input type="hidden" class="item-url-{{ $item->id }}" value="{{ route('page', $item->slug) }}">
                <input type="hidden" class="item-id-{{ $item->id }}" value="{{ $item->id }}">
                <input type="hidden" class="item-type-{{ $item->id }}" value="landing">
            </label>
        </div>
    @endforeach
@endif
