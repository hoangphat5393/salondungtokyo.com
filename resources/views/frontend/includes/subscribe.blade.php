<section class="block7">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="subscribe-block p-4">
                    <h4 class="mb-2">@lang('Electronic newsletter')</h4>
                    <form id="subscription_form" action="{{ route('subscription') }}" method="post" class="" novalidate="novalidate">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="visually-hidden">@lang('Email')</label>
                                <input type="email" class="form-control border-custom" id="email" name="subscription[email]" placeholder="@lang('Your email')">
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-custom btn-subscription">@lang('Register')</button>
                                <span class="ajax-loader"></span>
                            </div>
                        </div>
                    </form>
                    <p class="my-3">@lang('Recieve news') {{ setting_option('webtitle') }}</p>
                    <div class="d-flex align-items-center">
                        <p>@lang('Follow us')</p>
                        &emsp;&emsp;
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="{{ setting_option('facebook') }}" target="_blank">
                                    <img src="{{ asset('images/facebook.png') }}" style="width:35px" alt="Facebook">
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="{{ setting_option('twitter') }}" target="_blank">
                                    <img src="{{ asset('images/twitter.png') }}" style="width:35px" alt="Twitter">
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="{{ setting_option('youtube') }}" target="_blank">
                                    <img src="{{ asset('images/youtube.png') }} " style="width:35px" alt="Youtube">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@push('scripts')
    <script>
        $("#subscription_form").submit(function(e) {
            e.preventDefault();
        });
        // SUBSCRIPTION
        $(".btn-subscription").on("click", function() {
            var action = $(this).closest("form").attr("action"),
                email = $(this).closest("form").find('input[name="subscription[email]"]').val();

            axios({
                    method: "post",
                    url: action,
                    data: {
                        email: email
                    },
                })
                .then((res) => {
                    if (res.data.status == "success") {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: res.data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('input[name="subscription[email]"]').val();
                    } else {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: res.data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                })
                .catch((e) => console.log(e));
        });
    </script>
@endpush
