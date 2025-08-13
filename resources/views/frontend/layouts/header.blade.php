@php
    use Illuminate\Support\Facades\Auth;
    if (Auth::check()) {
        $user = Auth::user();
        $avatar = public_path('img/users/avatar/') . $user->avatar;
    }
    $lc = app()->getLocale();

    $headerMenu = \App\Models\Menus::where('name', 'Menu-main-' . $lc)->first();
@endphp


<header id="header" class="header">
    {{-- <div class="wrap">
        <div class="container">

            <ul class="nav justify-content-around justify-content-md-end align-items-center py-1 py-md-0">
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

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('registerCustomer') }}">@lang('Register')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">@lang('Login')</a>
                </li>

            </ul>
        </div>
    </div> --}}

</header>
