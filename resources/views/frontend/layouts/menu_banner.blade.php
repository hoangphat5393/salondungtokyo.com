@php
    use Illuminate\Support\Facades\Auth;
    if (Auth::check()) {
        $user = Auth::user();
        $avatar = public_path('img/users/avatar/') . $user->avatar;
    }
    $lc = app()->getLocale();

    $headerMenu = \App\Models\Menus::where('name', 'Menu-main-' . $lc)->first();
@endphp


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <a class="navbar-brand me-0 me-md-3" href="{{ route('index') }}">
            <div class="logo-slogan">
                <img class="img-fluid" src="{{ get_image(setting_option('logo_' . $lc)) }}" class="logo" alt="{{ setting_option('webtitle') }}">
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

            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
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
                    @endif
                </ul>
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
