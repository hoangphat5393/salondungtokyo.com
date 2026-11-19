@php
    $lc = app()->getLocale();
    $footerMenu = \App\Models\Frontend\Menu::where('name', 'Menu-footer-' . $lc)->first();
@endphp

{{-- Footer Start --}}
<footer id="footer" class="">

    <div class="container-lg footer-container">

        <div class="row footer-row justify-content-between align-items-center">
            {{--
            <div class="col-12 col-lg-4">
                <img src="{{ get_image(setting_option('logo_footer_' . $lc)) }}" class="logo-footer img-fluid d-block mx-auto" alt="{{ setting_option('webtitle') }}">
                <div class="d-flex justify-content-center justify-content-lg-left">
                    <ul class="list-inline mx-auto mt-3 social">
                        <li class="list-inline-item">
                            <a href="{{ setting_option('zalo') }}" target="_blank">
                                <img alt="Icon-Zalo" class="img-fluid" src="/upload/images/social/zalo-square.webp" data-src="/upload/images/social/zalo-square.webp">
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ setting_option('facebook') }}" target="_blank">
                                <img alt="Icon-Messager" class="img-fluid" src="/upload/images/social/facebook-square.webp" data-src="/upload/images/social/facebook-square.webp">
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ setting_option('instagram') }}" target="_blank">
                                <img alt="Icon-Instagram" class="img-fluid" src="/upload/images/social/instagram-square.webp" data-src="/upload/images/social/instagram-square.webp">
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ setting_option('tiktok') }}" target="_blank">
                                <img alt="Icon-Instagram" class="img-fluid" src="/upload/images/social/tiktok-square.webp" data-src="/upload/images/social/tiktok-square.webp">
                            </a>
                        </li>
                    </ul>
                </div>
            </div> --}}

            {{-- @empty(!$footerMenu)
                <div class="col-12 col-md-6 col-lg-4 footer__column-links my-4 my-lg-0">
                    <ul id="menu-footer" class="list-unstyled menu-footer">
                        @foreach ($footerMenu->items as $item)
                            <li class="text-center">
                                <a href="{{ $item->link }}">{{ $item->label }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endempty --}}


            {{-- <div class="col-12 col-md-6 col-lg-4 footer__column-links">
                <div class="fit-content mx-auto">

                    <p class="d-flex align-items-center mb-3 fit-content">
                        <i class="fas fa-envelope me-3"></i>
                        <span>{{ setting_option('email') }}</span>
                    </p>

                    <p class="d-flex align-items-center mb-3 fit-content">
                        <i class="fas fa-phone me-3"></i>
                        <span>{{ setting_option('phone') }}</span>
                    </p>
                    <p class="d-flex align-items-center fit-content">
                        <i class="fa-regular fa-globe me-3"></i>
                        <span>{{ setting_option('website') }}</span>
                    </p>
                </div>
            </div> --}}
        </div>

        <div class="row footer-copyright">
            <div class="col-12 text-center">
                <p>© 2022 {{ setting_option('webtitle') }}. All Rights Reserved.</p>
            </div>
        </div>
    </div>
    {{-- END FOOTER --}}
</footer>
