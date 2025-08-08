@extends($templatePath . '.layouts.index')

@php
    $lc = app()->getLocale();
@endphp

@push('lib-style')
    <link rel="stylesheet" href="{{ asset('plugin/datetimepicker/jquery.datetimepicker.min.css') }}">
@endpush

@push('head-script')
    {!! RecaptchaV3::initJs() !!}
@endpush

@section('content')
    <main id="main" class="register">
        [menu_no_banner]

        <section class="block17 page-register-content">
            <div class="container mt-4">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="wrap">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="p-3 p-lg-5">

                                        <h4 class="fw-bold fs-4 text-main">@lang('Create account') {{ setting_option('webtitle') }}</h4>
                                        <p class="my-2">@lang('More than 5 million people have registered')</p>

                                        <form id="customer_register" method="post" action="{{ route('postRegisterCustomer') }}">
                                            @csrf
                                            {!! RecaptchaV3::field('contact') !!}
                                            <div class="row mb-3 align-items-center">
                                                <div class="col-lg-6">
                                                    <label for="name" class="col-form-label">@lang('First and last name')</label>
                                                    <input type="input" name="name" id="name" class="form-control" placeholder="@lang('We call you?')" aria-describedby="username">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="birthday" class="col-form-label">@lang('Birthday')</label>
                                                    <input type="input" name="birthday" id="birthday" class="form-control" placeholder="@lang('Birthday')" aria-describedby="birthday">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label">@lang('Email')</label>
                                                <input type="email" name="email" id="email" class="form-control" placeholder="@lang('Email')" aria-describedby="email">
                                            </div>

                                            <div class="mb-3">
                                                <label for="phone" class="form-label">@lang('Phone')</label>
                                                <input type="phone" name="phone" id="phone" class="form-control" placeholder="@lang('Phone')" aria-describedby="phone">
                                            </div>
                                            <div class="form-note mb-3">
                                                {!! htmlspecialchars_decode(setting_option('register_phone_note_' . $lc)) !!}
                                            </div>

                                            <div class="mb-3">
                                                <label for="password" class="form-label">@lang('Password')</label>
                                                <input type="password" id="password" class="form-control" name="password" placeholder="@lang('Password')">
                                            </div>

                                            <div class="mb-3">
                                                <label for="password_confirm" class="form-label">@lang('Re-password')</label>
                                                <input type="password" id="password_confirm" class="form-control" name="password_confirm" placeholder="@lang('Re-password')">
                                            </div>

                                            <button type="button" class="btn btn-custom btn-register">@lang('Create new account')</button>
                                            {{-- <button type="submit" class="btn btn-custom">@lang('Create new account')</button> --}}

                                            <div class="form-note text-center mt-4">
                                                {!! htmlspecialchars_decode(setting_option('register_note_' . $lc)) !!}
                                            </div>

                                            <div class="mb-3">
                                                <div class="error-message"></div>
                                            </div>
                                            {{-- <div class="mb-3 form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                <label class="form-check-label footnote" for="exampleCheck1">
                                                    Với việc đồng ý tạo tài khoản đồng nghĩa với bạn đã đồng ý với Điều khoản dịch vụ &amp; Chính sách bảo mật của chúng tôi và nhận thông tin cập nhật hàng tuần. Cước phí tin nhắn và dung lượng mạng có thể bị tính.
                                                    Soạn STOP để từ chối nhận tin nhắn, HELP để nhờ trợ giúp
                                                </label>
                                            </div> --}}
                                        </form>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <img src="{{ asset('images/bg_register.jpg') }}" alt="login" class="img-fluid w-100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        {{-- Subscribe --}}
        @include('theme.includes.subscribe')
    </main>
@endsection


@push('lib-scripts')
    <script src="{{ asset('plugin/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
@endpush

@push('scripts')
    <script>
        $('#birthday').datetimepicker({
            format: 'Y-m-d',
            timepicker: false,
            // showTimezone: true,
        });

        var customer_register = $("#customer_register");
        var lc = '{{ app()->getLocale() }}';
        var register_success = '{{ route('user.register.success') }}';

        var error_messages = {
            name: "@lang('Enter first last name')",
            birthday: "@lang('Enter birthday')",
            phone: "@lang('Enter phone')",
            email: "@lang('Enter email')",
            password: "@lang('Enter password')",
            password_confirm: "@lang('Re-enter password')"
        }

        $(document).ready(function($) {
            customer_register.validate({
                onfocusout: false,
                onkeyup: false,
                onclick: false,
                rules: {
                    name: "required",
                    birthday: "required",
                    phone: "required",
                    email: "required",
                    password: "required",
                    password_confirm: {
                        required: true,
                        equalTo: '#password',
                    },
                    password_confirm: "required",
                },
                messages: error_messages,
                errorElement: 'div',
                errorLabelContainer: '.errorTxt',
                invalidHandler: function(event, validator) {
                    $('html, body').animate({
                        scrollTop: 0
                    }, 500);
                }
            });

            $('.btn-register').on('click', function(event) {
                if (customer_register.valid()) {
                    // customer_register.find('.list-content-loading').show();
                    var form = document.getElementById('customer_register');
                    var fdnew = new FormData(form);
                    axios({
                        method: 'POST',
                        url: customer_register.prop("action"),
                        data: fdnew,
                    }).then(res => {
                        if (res.data.status == "success") {
                            // $('.page-register-content').html(res.data.view);
                            window.location.replace(register_success);
                        } else {
                            // customer_register.find('.error-message').html(res.data.message);
                            // customer_register.find('.list-content-loading').hide();
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
