@php
    use Illuminate\Support\Facades\Auth;
    if (Auth::check()) {
        $user = Auth::user();
        $avatar = public_path('img/users/avatar/') . $user->avatar;
    }
    $lc = app()->getLocale();

    $headerMenu = \App\Models\Frontend\Menu::where('name', 'Menu-main')->first();

    // dd($headerMenu);

@endphp

{{-- bg-light sticky-top --}}
<nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container">

        <a class="navbar-brand me-0 me-md-3" href="{{ route('index') }}">
            <div class="logo-slogan">
                <img class="img-fluid logo" src="{{ get_image(setting_option('logo')) }}" alt="{{ setting_option('webtitle') }}" width="120px">
            </div>
        </a>

        <button class="navbar-toggler " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

            <div class="offcanvas-header">
                {{-- <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5> --}}
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body justify-content-end">

                <div class="">
                    {{-- <ul class="navbar-nav justify-content-end align-items-center flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ Route::localizedUrl('vi') }}">
                                <img class="" src="{{ asset('images/icon/vi.png') }}" width="30" height="30" alt="@lang('Viet Nam')">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ Route::localizedUrl('en') }}">
                                <img class="" src="{{ asset('images/icon/en.png') }}" width="30" height="30" alt="@lang('English')">
                            </a>
                        </li>
                    </ul> --}}

                    <ul class="navbar-nav justify-content-end align-items-center flex-grow-1 pe-3">
                        @if ($headerMenu)
                            @foreach ($headerMenu->items as $item)
                                @php $hasChild = $item->child()->exists(); @endphp
                                @if ($hasChild != 1)
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="{{ $item->link }}">{{ $item->label }}</a>
                                    </li>
                                @else
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ $item->label }}
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            @foreach ($item->child as $item2)
                                                <li><a class="dropdown-item" href="{{ $item2->link }}">{{ $item2->label }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endforeach

                            {{-- <li class="nav-item">
                                <a class="nav-link active" href="{{ Route::localizedUrl('vi') }}">
                                    <img class="" src="{{ asset('images/icon/vi.png') }}" width="30" height="30" alt="@lang('Viet Nam')">
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ Route::localizedUrl('en') }}">
                                    <img class="" src="{{ asset('images/icon/en.png') }}" width="30" height="30" alt="@lang('English')">
                                </a>
                            </li> --}}
                        @endif
                    </ul>
                </div>

                {{-- <form class="d-flex" role="search" method="get" action="{{ route('search') }}">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control input-search" placeholder="@lang('Search')" aria-label="@lang('Search')" aria-describedby="basic-addon2">
                        <button type="submit" class="input-group-text btn-search" id="search"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form> --}}
            </div>
        </div>
    </div>
</nav>
