@php
    // dd($files);
@endphp

@foreach ($files as $file)
    @php
        // Lấy đường dẫn tương đối từ thư mục public
        $relativePath = str_replace(public_path(), '', $file->getPathname());
        // Loại bỏ ký tự '/' đầu tiên nếu có
        $relativePath = ltrim($relativePath, '/');
        $relativePath = ltrim($relativePath, '\\');

        // dd($file->getFilename(), $file->getPathname());
        // dd($relativePath, public_path(), $file->getPathname());
        $relativePath = str_replace('\\', '/', $relativePath);
        // dd($relativePath);
    @endphp
    {{-- {{ $file->getPathname() }}
    {{ $file->getFilename() }} --}}
    {{-- {{ $relativePath }} --}}
    {{-- <p><img alt="" src="/upload/images/case_study/KHE%20GROUP/1.jpg" style="width:100%" /></p> --}}
    <p><img alt="" src="/{{ $relativePath }}" style="width:100%" /></p>

    <p>&nbsp;</p>
@endforeach
