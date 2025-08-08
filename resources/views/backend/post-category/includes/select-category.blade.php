@php
    $data_type = $data_type ?? '';
    $parent = $parent ?? 0;
@endphp

@if ($data_type == '')
    @php
        $db = \App\Models\Backend\Category::where('status', 1)->where('type', 'post')->where('parent', 0);
        if (isset($id)) {
            $db->whereNot('id', $id);
        }
        $categories = $db->get();
    @endphp
    <select class="custom-select mr-2" name="parent">
        <option value="0">== @lang('Do not have') ==</option>
        @if ($categories->count() > 0)
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $parent == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @if ($category->children('post')->get())
                    @include('backend.post-category.includes.select-category', [
                        'data' => $category->children('product')->get(),
                        'data_type' => 'option',
                        'parent' => $parent,
                        'slit' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                    ])
                @endif
            @endforeach
        @endif
    </select>
@else
    @foreach ($data as $item)
        <option value="{{ $item->id }}" {{ $parent == $item->id ? 'selected' : '' }}>{!! $slit !!}{{ $item->name }}</option>
        @if ($item->children('post')->get())
            @include('backend.post-category.includes.select-category', [
                'data' => $item->children('post')->get(),
                'data_type' => 'option',
                'parent' => $parent,
                'slit' => $slit . '&nbsp;&nbsp;&nbsp;&nbsp;',
            ])
        @endif
    @endforeach
@endif
