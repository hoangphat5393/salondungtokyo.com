@php
    $lc = app()->getLocale();
    $headerMenu = \App\Models\Menus::where('name', 'Menu-main-' . $lc)->first();
@endphp

<nav class="navbar navbar-expand-lg menu-wrap d-none d-lg-block">
    <div class="container">
        {{-- <a class="navbar-brand" href="#">Navbar scroll</a> --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll d-column">
                @empty(!$headerMenu)
                    @foreach ($headerMenu->items as $item)
                        @php $hasChild = $item->child()->exists(); @endphp
                        @if ($hasChild == 1)
                            <li class="nav-item dropdown {{ $item->class }}">
                                <a class="nav-link menu-link d-none d-lg-block" href="{{ $item->link }}" role="button" aria-expanded="false">
                                    {{ $item->label }}
                                </a>
                                <a class="nav-link dropdown-toggle d-block d-lg-none" href="{{ $item->link }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $item->label }}
                                </a>
                                @if ($item->class == 'project')
                                    <div class="dropdown-menu">
                                        <div class="container-fluid px-3 py-2">
                                            <div class="row g-3">
                                                @foreach ($item->child as $item2)
                                                    <div class="col-lg-3">
                                                        <a href="{{ $item2->link }}">
                                                            <div class="header-project">
                                                                <img src="{{ get_image($item2->image) }}" class="w-100" alt="{{ $item2->name }}">
                                                                <p class="title px-3">{{ $item2->label }}</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <ul class="dropdown-menu">
                                        @foreach ($item->child as $item2)
                                            <li><a class="dropdown-item" href="{{ $item2->link }}">{{ $item2->label }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @else
                            <li class="nav-item">
                                <a @class(['nav-link', 'active' => $loop->iteration == 1]) aria-current="page" href="{{ $item->link }}">{{ $item->label }}</a>
                            </li>
                        @endif
                    @endforeach
                @endempty
            </ul>
            <form class="d-flex" role="search" method="get" action="{{ route('search') }}">
                <div class="input-group input-group-search">
                    <button type="submit" class="input-group-text bg-transparent border-0 btn-search" id="header_search">
                        <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                    </button>
                    <input type="text" class="form-control bg-transparent border-0 input-search text-white" value="{{ request('keyword') }}" name="keyword" placeholder="@lang('Search')" aria-label="@lang('Search')" aria-describedby="header_search">
                </div>
            </form>
        </div>
    </div>
</nav>

@push('scripts')
    {{-- <script>
        $('.dropdown-link').on('click', function() {
            console.log(123);
            window.location.href = $(this).attr('href');
        });
    </script> --}}
@endpush
