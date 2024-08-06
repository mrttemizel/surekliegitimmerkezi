@extends('backend.components.master')
@section('title')
    Kullanıcı Ekle
@endsection
@section('css')
    <link href="{{asset('backend/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
           Kullanıcılar
        @endslot
        @slot('title')
            Kullanıcı Ekle
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            @if (session()->get('success'))
                <div class="alert alert-success alert-dismissible alert-solid alert-label-icon fade show"
                     role="alert">
                    <i class="ri-check-double-line label-icon"></i><strong>  {{ session()->get('success') }}</strong></strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                </div>
            @endif
            @if (session()->get('error'))
                <div class="alert alert-danger alert-dismissible alert-solid alert-label-icon fade show"
                     role="alert">
                    <i class="ri-check-double-line label-icon"></i><strong>  {{ session()->get('success') }}</strong></strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                </div>
            @endif
            <div class="card ">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Kullanıcı Ekle</h4>
                    <a href="{{ route('users.index') }}" class="btn btn-primary waves-effect waves-light d-flex justify-content-between"><i class="ri-arrow-go-back-fill"></i> &nbsp; Geri Dön</a>

                </div><!-- end card header -->
                <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-3">
                                <div class="col-xl-6 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Ad Soyad <span class="text-danger">*</span></label>
                                        <input type="text" name="name" placeholder="Ad Soyad" class="form-control" value="{{ old('name') }}">
                                        <span class="text-danger">
                                    @error('name')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xl-6 col-md-6">
                                    <div>
                                        <label for="labelInput" class="form-label">E-Posta <span class="text-danger">*</span></label>
                                        <input type="text" name="email" placeholder="E-Posta Adresi" class="form-control" value="{{ old('email') }}">
                                        <span class="text-danger">
                                    @error('email')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xl-6 col-md-6">
                                    <div>
                                        <label for="labelInput" class="form-label">Telefon</label>
                                        <input type="text"  name="phone" class="form-control" value="{{ old('phone') }}" id="cleave-phone" placeholder="(xxx)xxx-xxxx">
                                        <span class="text-danger">
                                    @error('phone')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div>
                                        <label for="formFile" class="form-label">Profil Resmi</label>
                                        <input class="form-control"  type="file" name="image">
                                        <span class="text-danger">
                                    @error('image')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                    <!-- end card -->
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div>
                                        <label for="exampleInputpassword" class="form-label">Şifre <span class="text-danger">*</span></label>
                                        <input type="password" name="password" placeholder="Şifre" class="form-control">
                                        <span class="text-danger">
                                    @error('password')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>

                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div>
                                        <label for="exampleInputpassword" class="form-label">Şifre Tekrar <span class="text-danger">*</span></label>
                                        <input type="password" name="password_confirmation"  placeholder="Şifre Tekrar" class="form-control">
                                        <span class="text-danger">
                                    @error('password_confirmation')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>

                                </div>
                                <div class="col-xl-12 col-md-12">
                                    <div>
                                        <label for="labelInput" class="form-label">Kullanıcı Rolü <span class="text-danger">*</span></label>
                                        <select class="form-select" name="status"  aria-label="Default select example">
                                            <option selected disabled>Kullanıcı Rolü Seçiniz</option>
                                                <option value="1">Yönetici</option>
                                                <option value="2">Kullanıcı</option>
                                        </select>
                                        <span class="text-danger">
                                    @error('status')
                                            {{ $message }}
                                            @enderror
                                    </span>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-primary">Ekle</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </form>
            </div>
        </div>
    </div>






@endsection



@section('addjs')

    <script src="{{asset('backend/assets/libs/cleave.js/addons/cleave-phone.ve.js')}}"></script>
    <script src="{{asset('backend/assets/libs/cleave.js/cleave.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/pages/form-masks.init.js')}}"></script>

@endsection
