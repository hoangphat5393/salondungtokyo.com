@extends('theme.layouts.index')

@php
    $lc = app()->getLocale();
@endphp

@section('seo')
    @include('theme.layouts.seo', $seo ?? [])
@endsection

@push('head-script')
    {!! RecaptchaV3::initJs() !!}
@endpush


{{-- @section('body-class', 'page-template-default page page-id-1940') --}}

@section('content')
    @include('theme.layouts.menu')

    <main id="contact">

        <section class="block10 py-5">

            <div class="container bg-white py-5">

                {{-- @empty(!$page)
                    {!! htmlspecialchars_decode($page->content) !!}
                @endempty --}}

                <div class="row mb-5">
                    <div class="col">
                        <h1 class="text-center">CONTACT US</h1>
                    </div>
                </div>

                <div class="row justify-content-around">
                    <div class="col-12 col-md-4 mb-5">
                        <h2 class="text-center">
                            <a href="mailto:{{ setting_option('email') }}">BECOME OUR CLIENT</a>
                        </h2>
                    </div>

                    <div class="col-12 col-md-4 mb-5">
                        <h2 class="text-center">
                            <a href="mailto:{{ setting_option('email') }}">BECOME OUR MEMBER</a>
                        </h2>
                    </div>
                </div>

                <div class="row justify-content-end">
                    <div class="col-12 col-md-6 mb-5">
                        <div class="d-flex justify-content-center">
                            <a href="{{ setting_option('zalo') }}" target="_blank" class="social">
                                <img alt="Icon-Zalo" class="img-fluid" src="/upload/images/social/zalo-square.webp" data-src="/upload/images/social/zalo-square.webp">
                            </a>

                            <a href="{{ setting_option('facebook') }}" target="_blank" class="social">
                                <img alt="Icon-Messager" class="img-fluid" src="/upload/images/social/facebook-square.webp" data-src="/upload/images/social/facebook-square.webp">
                            </a>

                            <a href="{{ setting_option('instagram') }}" target="_blank" class="social">
                                <img alt="Icon-Instagram" class="img-fluid" src="/upload/images/social/instagram-square.webp" data-src="/upload/images/social/instagram-square.webp">
                            </a>

                            <a href="{{ setting_option('tiktok') }}" target="_blank" class="social">
                                <img alt="Icon-Instagram" class="img-fluid" src="/upload/images/social/tiktok-square.webp" data-src="/upload/images/social/tiktok-square.webp">
                            </a>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 mb-5">
                        <h2 class="text-center">OUR OFFICE</h2>
                        <p class="text-center">{{ setting_option('address_' . $lc) }}</p>
                    </div>
                </div>

            </div>

        </section>

    </main>
@endsection

@push('scripts')
    <script>
        // CONTACT
        var contact_form = $("#contact_form");
        var lc = '{{ app()->getLocale() }}';
        var contact_success = '{{ route('contact_completed') }}';

        var error_messages = {
            "contact[name]": "@lang('Enter first last name')",
            "contact[email]": {
                required: "@lang('Enter email')",
                email: "@lang('Enter valid email')",
            },
            "contact[phone]": {
                required: "@lang('Enter Phone')",
                number: "@lang('Enter valid phone')",
                digits: "@lang('Enter valid phone')",
                minlength: "@lang('Enter valid phone')",
            },
            "contact[content]": {
                required: "@lang('Enter content')",
                minlength: "@lang('Enter minimum characters')",
                maxlength: "@lang('Enter maximun characters')",
            }
        }

        $(document).ready(function($) {
            contact_form.validate({
                onfocusout: false,
                onkeyup: false,
                onclick: false,
                rules: {
                    "contact[name]": "required",
                    "contact[email]": {
                        required: true,
                        email: true,
                    },
                    "contact[phone]": {
                        number: true,
                        digits: true,
                        minlength: 10,
                    },
                    "contact[content]": {
                        required: true,
                        minlength: 10,
                        maxlength: 200,
                    },
                },
                messages: error_messages,
                errorElement: "div",
                errorLabelContainer: ".errorTxt",
                invalidHandler: function(event, validator) {
                    $("html, body").animate({
                        scrollTop: contact_form.offset().top
                    }, 500);
                },
            });

            $('.btn-contact-submit').on('click', function(event) {
                if (contact_form.valid()) {
                    var form = document.getElementById('contact_form');
                    var fdnew = new FormData(form);
                    axios({
                        method: 'POST',
                        url: contact_form.prop("action"),
                        data: fdnew,
                    }).then(res => {
                        if (res.data.status == "success") {
                            console.log('success');
                            window.location.replace(contact_success);
                        } else {
                            Swal.fire({
                                position: "center",
                                icon: "error",
                                title: res.data.message,
                                // showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    }).catch(e => console.log(e));
                }
            });
        });
    </script>
@endpush
