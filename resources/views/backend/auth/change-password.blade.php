@extends('backend.components.master-withoutnavbar')
@section('title')
    Change Password
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
                                    <p class="text-muted mt-4">Yeni şifreniz daha önce kullandığınız şifreden farklı olmalıdır.</p>
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

                                <div class="p-2">
                                    <form action="{{ route('auth.reset_password_submit') }}" method="POST">
                                        @csrf

                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <input type="hidden" name="email" value="{{ $email }}">
                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Şifre</label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input type="password" name="password" class="form-control pe-5 password-input" onpaste="return false" placeholder="Şifre" id="password-input">
                                            </div>
                                            <span class="text-danger">
                                                @error('password')
                                                {{ $message }}
                                                @enderror
                                            </span>
                                            <div id="passwordInput" class="form-text">En az 8 karakter olmalıdır.</div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="confirm-password-input">Şifreyi Onayla</label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input type="password" name="password_confirmation" class="form-control pe-5 password-input" onpaste="return false" placeholder="Şifreyi Onayla">
                                            </div>
                                            <span class="text-danger">
                                            @error('password_confirmation')
                                                {{ $message }}
                                                @enderror
                                    </span>
                                        </div>


                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Şifremi Sıfırla</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">Bekle, şifremi hatırlıyorum.... <a href="auth-signin-basic"
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
