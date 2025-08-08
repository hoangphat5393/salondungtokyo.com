@extends($templatePath . '.layouts.index')

@section('content')
    <main id="main" class="login">
        [menu_no_banner]

        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="wrapper -half" data-wpmeteor-mouseover="true" data-wpmeteor-mouseout="true">
                        <div class="dangkytaikhoan" data-wpmeteor-mouseover="true" data-wpmeteor-mouseout="true">
                            <!--display error/success message-->

                            <div class="container__block">
                                <h4 style="color: #20a19f;font-size: 25px;font-weight: 700;" data-wpmeteor-mouseover="true" data-wpmeteor-mouseout="true">Tạo tài khoản OneHealth Foundation</h4>
                                <p data-wpmeteor-mouseover="true" data-wpmeteor-mouseout="true">Hơn 5 triệu người đã đăng ký </p>
                            </div>

                            <div class="container__block" data-wpmeteor-mouseover="true" data-wpmeteor-mouseout="true">
                                <ul class="form-actions -inline" data-wpmeteor-mouseover="true" data-wpmeteor-mouseout="true">
                                    <li>
                                        <div class="fb-login-button fb_iframe_widget" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true" onlogin="checkLoginState();" scope="public_profile,email"
                                            login_text="" fb-xfbml-state="rendered"
                                            fb-iframe-plugin-query="app_id=253803351861297&amp;auto_logout_link=false&amp;button_type=continue_with&amp;container_width=0&amp;locale=en_US&amp;login_text=&amp;max_rows=1&amp;scope=public_profile%2Cemail&amp;sdk=joey&amp;show_faces=false&amp;size=large&amp;use_continue_as=true">
                                            <span style="vertical-align: bottom; width: 231px; height: 40px;"><iframe name="f7ccdf6234adf51f7" width="1000px" height="1000px" data-testid="fb:login_button Facebook Social Plugin" title="fb:login_button Facebook Social Plugin" frameborder="0"
                                                    allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media"
                                                    src="https://www.facebook.com/v3.1/plugins/login_button.php?app_id=253803351861297&amp;auto_logout_link=false&amp;button_type=continue_with&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Dff809b13559a20046%26domain%3Donehealth.foundation%26is_canvas%3Dfalse%26origin%3Dhttps%253A%252F%252Fonehealth.foundation%252Ff5547454ae2528a2c%26relation%3Dparent.parent&amp;container_width=0&amp;locale=en_US&amp;login_text=&amp;max_rows=1&amp;scope=public_profile%2Cemail&amp;sdk=joey&amp;show_faces=false&amp;size=large&amp;use_continue_as=true"
                                                    style="border: none; visibility: visible; width: 231px; height: 40px;" class=""></iframe></span>
                                        </div>
                                        <div class="fb-login-button d-none fb_iframe_widget" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false" login_text="" fb-xfbml-state="rendered"
                                            fb-iframe-plugin-query="app_id=253803351861297&amp;auto_logout_link=false&amp;button_type=continue_with&amp;container_width=0&amp;locale=en_US&amp;login_text=&amp;max_rows=1&amp;sdk=joey&amp;show_faces=false&amp;size=large&amp;use_continue_as=false"><span
                                                style="vertical-align: bottom; width: 0px; height: 0px;"><iframe name="fa1fc58b9e87d9366" width="1000px" height="1000px" data-testid="fb:login_button Facebook Social Plugin" title="fb:login_button Facebook Social Plugin" frameborder="0"
                                                    allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media"
                                                    src="https://www.facebook.com/v3.1/plugins/login_button.php?app_id=253803351861297&amp;auto_logout_link=false&amp;button_type=continue_with&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df482c6ec01258fafb%26domain%3Donehealth.foundation%26is_canvas%3Dfalse%26origin%3Dhttps%253A%252F%252Fonehealth.foundation%252Ff5547454ae2528a2c%26relation%3Dparent.parent&amp;container_width=0&amp;locale=en_US&amp;login_text=&amp;max_rows=1&amp;sdk=joey&amp;show_faces=false&amp;size=large&amp;use_continue_as=false"
                                                    class="" style="border: none; visibility: visible; width: 0px; height: 0px;"></iframe></span></div>
                                        <a class="d-none" href="https://www.facebook.com/dialog/oauth?client_id=253803351861297&amp;redirect_uri=https://demo.dieuuoc.orglocal/register&amp;scope=public_profile"><img
                                                src="https://onehealth.foundation/wp-content/themes/thewish/img/icon/facebook-sign-in.png" width="210px"></a>
                                    </li>
                                    <li><a href="/clients-login/" class="button">Đăng nhập</a></li>
                                </ul>
                                <span class="divider"></span>
                            </div>

                            <div class="container__block -centered">

                                <form class="form-horizontal" method="post" role="form" id="profile-registration-form">
                                    <!--<input name="_token" value="x7ISaZD7qezh85FDpJG5qlVcNYhZJExCEYjmiOjA" type="hidden">-->
                                    <div>
                                        <div class="form-group d-none">
                                            <label class="control-label  col-sm-3" for="username">Tên đăng nhập: </label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="username" id="username" placeholder="Tên đăng nhập:" value="">
                                            </div>
                                        </div>
                                        <div class="form-item -reduced">
                                            <label for="first_name" class="field-label">
                                                <div class="validation">
                                                    <div class="validation__label">Họ &amp; Tên </div>
                                                    <div class="validation__message"></div>
                                                </div>
                                            </label>
                                            <input name="first_name" id="first_name" class="text-field required js-validate" placeholder="Chúng tôi gọi bạn là?" value="" autofocus="" data-validate="first_name" data-validate-required="" type="text">
                                        </div>

                                        <div class="form-item -reduced">
                                            <label for="birthdate" class="field-label">
                                                <div class="validation">
                                                    <div class="validation__label">Ngày Sinh</div>
                                                    <div class="validation__message"></div>
                                                </div>
                                            </label>
                                            <input type="date" class="form-control text-field" name="birthdate" id="birthdate" placeholder="Ngày/ tháng/ Năm" max="3000-12-31" min="1000-01-01" required="">
                                        </div>
                                    </div>

                                    <div class="form-item">
                                        <label for="email" class="field-label">
                                            <div class="validation">
                                                <div class="validation__label">Email</div>
                                                <div class="validation__message"></div>
                                            </div>
                                        </label>
                                        <input type="email" class="form-control text-field" name="email" id="email" placeholder="Email">
                                    </div>

                                    <div class="form-item">
                                        <label for="mobile" class="field-label">
                                            <div class="validation">
                                                <div class="validation__label">Số Điện Thoại</div>
                                                <div class="validation__message"></div>
                                            </div>
                                        </label>
                                        <input name="mobile" id="mobile" class="text-field js-validate" placeholder="" type="tel">
                                    </div>
                                    <div class="form-item">
                                        <p class="footnote">
                                            OneHealth Foundation sẽ gửi bạn những hoạt động mới nhất thông qua tổng đài của chúng tôi, 028-710 77777. Bạn có thể nhận được 8 hoạt động mới nhất mỗi tháng từ chúng tôi. Tin nhắn và dung lượng có thể bị tính phí. Soạn HELP gửi 028-710 77777 nếu bạn có thắc
                                            mắc. Soạn
                                            STOP đến 028-710 77777 để từ chối nhận tin nhắn. Vui lòng xem lại trang Điều khoản dịch vụ và Chính sách bảo mật.<!--                                <em>OneHealth Foundation sẽ gửi bạn những hoạt động mới nhất thông qua-->
                                        </p>
                                    </div>

                                    <div class="form-item password-visibility">
                                        <label for="password" class="field-label">
                                            <div class="validation">
                                                <div id="validation__label" style="display: none;">Password</div>
                                                <div id="validation__message" style="color: red;">not matching</div>
                                            </div>
                                        </label>
                                        <input type="password" class="form-control text-field" name="pwd1" id="pwd1" onkeyup="check();" placeholder="Nhập mật khẩu"><br>
                                        <input type="password" class="form-control text-field" name="pwd2" id="pwd2" onkeyup="check();" placeholder="Nhập lại mật khẩu">
                                    </div>

                                    <div class="form-actions -padded -left">
                                        <!--<input id="register-submit" class="button" value="Tạo Tài Khoản Mới" type="submit">-->
                                        <button type="submit" class="button btn btn-primary" id="register-btn">Tạo Tài Khoản Mới </button>
                                        <input type="hidden" name="task" value="register">
                                    </div>
                                </form>
                            </div>

                            <div class="container__block -centered">
                                <p class="footnote">
                                    Với việc đồng ý tạo tài khoản đồng nghĩa với bạn đã đồng ý với Điều khoản dịch vụ &amp; Chính sách bảo mật của chúng tôi và nhận thông tin cập nhật hàng tuần. Cước phí tin nhắn và dung lượng mạng có thể bị tính. Soạn STOP để từ chối nhận tin nhắn, HELP để nhờ trợ giúp
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('images/bg_register.jpg') }}" alt="login">
                </div>
            </div>
        </div>


    </main>
    <div id="page-content" class="page-template mt-5">
        <!--Page Title-->
        <div class="page section-header text-center">
            <div class="page-title">
                <div class="wrapper">
                    <h1 class="page-width">Login</h1>
                </div>
            </div>
        </div>
        <!--End Page Title-->

        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
                    <div class="mb-4">
                        <form method="post" action="{{ route('loginCustomerAction') }}" id="form-login-page" accept-charset="UTF-8">
                            <div class="list-content-loading">
                                <div class="half-circle-spinner">
                                    <div class="circle circle-1"></div>
                                    <div class="circle circle-2"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating form-floating-custom icon">
                                        <img class="form-icon" src="{{ asset($templateFile . '/images/email-icon.png') }}" alt="Email">
                                        <input type="text" class="form-control form-control-custom" id="email" name="email" placeholder="Your Email" value="{{ $email ?? '' }}">
                                        <label for="email" class="float-label-custom">Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating form-floating-custom icon">
                                        <img class="form-icon" src="{{ asset($templateFile . '/images/lock-icon.png') }}" alt="Phone">
                                        <input type="password" class="form-control form-control-custom" id="password" name="password" placeholder="Password">
                                        <label for="ship_mail" class="float-label-custom">Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="error-message"></div>
                                </div>
                                <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                                    <button type="button" class="btn mb-3 btn-custom btn-login-page">@lang('Sign In')</button>
                                    <p class="mb-4">
                                        <a href="{{ route('forgetPassword') }}" id="RecoverPassword">Forgot your
                                            password?</a> &nbsp; | &nbsp;
                                        <a href="{{ route('registerCustomer') }}" id="customer_register_link">Create
                                            account</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!--================================= Modal login -->
    <div class="modal login fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="list-content-loading">
                    <div class="half-circle-spinner">
                        <div class="circle circle-1"></div>
                        <div class="circle circle-2"></div>
                    </div>
                </div>

                <div class="modal-header border-0">
                    <h5 class="modal-title" id="loginModalLabel">Đăng nhập</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('after-footer')
    <script>
        jQuery(document).ready(function($) {
            var login_page = $('#form-login-page');
            login_page.validate({
                onfocusout: false,
                onkeyup: false,
                onclick: false,
                rules: {
                    email: "required",
                    password: "required",
                },
                messages: {
                    email: "Nhập địa chỉ E-mail",
                    password: "Nhập mật khẩu",
                },
                errorElement: 'div',
                errorLabelContainer: '.errorTxt',
                invalidHandler: function(event, validator) {
                    $('html, body').animate({
                        scrollTop: 0
                    }, 500);
                }
            });

            $('.btn-login-page').click(function(event) {
                if (login_page.valid()) {
                    var form = document.getElementById('form-login-page');
                    var fdnew = new FormData(form);
                    login_page.find('.list-content-loading').show();
                    axios({
                        method: 'POST',
                        url: '/customer/login',
                        data: fdnew,

                    }).then(res => {
                        console.log(res.data);
                        if (res.data.error == 0) {
                            $('#loginModal').find('.modal-body').html(res.data.view);
                            $('#loginModal').find('.modal-footer').remove();
                            $('#loginModal').modal('show');

                            $('#loginModal').on('hidden.bs.modal', function(e) {
                                window.location.href = "/";
                            })
                        } else {
                            login_page.find('.list-content-loading').hide();
                            login_page.find('.error-message').html(res.data.msg);
                        }
                        // login_page.find('.list-content-loading').hide();
                    }).catch(e => console.log(e));
                }
            });
        });
    </script>
@endpush
