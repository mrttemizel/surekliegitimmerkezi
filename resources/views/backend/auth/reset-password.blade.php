@extends('backend.components.master-withoutnavbar')
@section('title')
    Reset Password
@endsection
@section('content')
    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                     viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row mt-5">
                    <div class="col-lg-12 mt-5">

                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <img src="{{ asset('backend/my-image/abu-renkli.svg') }}" alt="" height="60">
                                    <h5 class="text-primary mt-4">Şifre Sıfırlama E-postası Gönder</h5>


                                    <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop"
                                               colors="primary:#0ab39c" class="avatar-xl">
                                    </lord-icon>

                                </div>

                                <div class="alert alert-borderless alert-warning text-center mb-2 mx-2" role="alert">
                                    E-postanızı girin, talimatlar size gönderilecek!
                                </div>
                                @if (session()->get('error'))
                                    <div class="alert alert-danger alert-border-left alert-dismissible fade show"
                                         role="alert">
                                        <i class="ri-error-warning-line me-3 align-middle"></i> <strong>
                                            {{ session()->get('error') }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session()->get('success'))
                                    <div class="alert alert-success alert-dismissible alert-solid alert-label-icon fade show"
                                         role="alert">
                                        <i class="ri-check-double-line label-icon"></i><strong>  {{ session()->get('success') }}</strong></strong>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                    </div>
                                @endif

                                <div class="p-2">
                                    <form action="{{route('auth.reset-password-link')}}" method="POST">
                                        @csrf
                                        <div class="mb-4">
                                            <label class="form-label">E-Posta Adresi</label>
                                            <input type="text" class="form-control" id="email" name="email">
                                            <span class="text-danger">
                                                @error('email')
                                                {{ $message }}
                                                @enderror
                                            </span>
                                        </div>

                                        <div class="mb-3">

                                            <div id="recaptcha_form"></div>
                                            <span class="text-danger">
                                            @error('g-recaptcha-response')
                                            {{ $message }}
                                            @enderror

                                        </div>

                                        <div class="text-center mt-4">
                                            <button class="btn btn-success w-100" id="reset_button" type="submit">Sıfırlama Linki
                                                Gönder</button>
                                        </div>
                                    </form><!-- end form -->
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">Bekle, şifremi hatırlıyorum.... <a href="{{ route('auth.login') }}"
                                                                               class="fw-semibold text-primary text-decoration-underline"> Giriş Yap </a> </p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->


    </div>
    <!-- end auth-page-wrapper -->
@endsection
@section('addjs')
    <script>
        $(document).on('click', '#reset_button', function () {
            $('#reset_button').html('Sıfırlama E-Postası Gönderiliyor...');
            $('#reset_button').addClass("disabled");
        });
    </script>

    {!!  GoogleReCaptchaV2::render('recaptcha_form') !!}
@endsection
