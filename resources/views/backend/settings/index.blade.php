@extends('backend.components.master')
@section('title')
    Site Ayarları
@endsection
@section('css')
    <link href="{{asset('backend/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Ayarlar
        @endslot
        @slot('title')
            Site Ayarları
        @endslot
    @endcomponent
    <!-- Display Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif



    <div class="row mt-5" >
        <!--end col-->
        <div class="col-xxl-12">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <!--end tab-pane-->
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#changeLogo" role="tab">
                                <i class="far fa-user"></i> Logo İşlemleri
                            </a>
                        </li>
                        <!--end tab-pane-->
                        <li class="nav-item">
                            <a class="nav-link " data-bs-toggle="tab" href="#changeContanct" role="tab">
                                <i class="fas fa-home"></i> İletişim İşlemleri
                            </a>
                        </li>
                        <!--end tab-pane-->
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#changeSocial" role="tab">
                                <i class="far fa-user"></i> Sosyal Medya İşlemleri
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#changeKatilim" role="tab">
                                <i class="far fa-user"></i> Katılım Sertifikası
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#changeCustomSert" role="tab">
                                <i class="far fa-user"></i> Temel Sertifika
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#changemultilang" role="tab">
                                <i class="far fa-user"></i> TR - ENG Sertifika
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="changeLogo" role="tabpanel">
                            <form action="{{ route('settings.logo.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="logo" class="form-label">Logo <br> <span class="text-danger">-Ölçüler 208x44 px olmalıdır!<br>- Yükleyebileceğiniz maksimum dosya boyutu 2MB'dır.</span></label>
                                            <input type="file"  id="logo" name="logo" class="form-control">
                                            <span class="text-danger">
                                                @error('logo')
                                                {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="logo_footer" class="form-label">Logo Footer <br> <span class="text-danger">- Ölçüler 208x44 px olmalıdır!<br>- Yükleyebileceğiniz maksimum dosya boyutu 2MB'dır.</span></label>
                                            <input type="file"  id="logo_footer" name="logo_footer" class="form-control">
                                            <span class="text-danger">
                                                @error('logo_footer')
                                                {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="favicon" class="form-label">Favicon <br> <span class="text-danger">- Ölçüler 50x44 px olmalıdır!<br>- Yükleyebileceğiniz maksimum dosya boyutu 2MB'dır.</span></label>
                                            <input type="file" id="favicon" class="form-control" name="favicon">
                                            <span class="text-danger">
                                                @error('favicon')
                                                {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary">Güncelle</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane" id="changeContanct" role="tabpanel">
                            <form action="{{ route('settings.contact.update') }}" method="POST"
                                  id="changeContactForm">
                                @csrf
                                <div class="row g-2">
                                    <div class="col-lg-12">
                                        <div>
                                            <label for="email" class="form-label">E-Posta</label>
                                            <input type="text" class="form-control" value="{{$data->email}}" name="email"
                                                   id="email">
                                            <span class="text-danger error_text  email_error"></span>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div>
                                            <label for="phonebir" class="form-label">Telefon 1</label>
                                            <input type="text" class="form-control" value="{{$data->phonebir}}" name="phonebir"
                                                   id="phonebir">
                                            <span class="text-danger error_text  phonebir_error"></span>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div>
                                            <label for="phoneiki" class="form-label">Telefon 2</label>
                                            <input type="text" class="form-control" value="{{$data->phoneiki}}" name="phoneiki"
                                                   id="phoneiki">
                                            <span class="text-danger error_text  phoneiki_error"></span>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div>
                                            <label for="fax" class="form-label">Fax</label>
                                            <input type="text" class="form-control" value="{{$data->fax}}" name="fax"
                                                   id="fax">
                                            <span class="text-danger error_text  fax_error"></span>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div>
                                            <label for="address" class="form-label">Adres</label>
                                            <input type="text" class="form-control" value="{{$data->address}}" name="address"
                                                   id="address">
                                            <span class="text-danger error_text  address_error"></span>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Güncelle</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane" id="changeSocial" role="tabpanel">
                            <form action="{{ route('settings.social.update') }}" method="POST"  id="changeSocialForm">
                                @csrf
                                <div class="row g-2">
                                    <div class="col-lg-12">
                                        <div>
                                            <label for="instagram" class="form-label">İnstagram</label>
                                            <input type="text" class="form-control" name="instagram"
                                                   id="instagram" value="{{ $data->instagram }}">
                                            <span class="text-danger error_text  instagram_error"></span>
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-12">
                                        <div>
                                            <label for="youtube" class="form-label">Youtube</label>
                                            <input type="text" class="form-control" name="youtube"
                                                   id="youtube" value="{{ $data ? $data->youtube : '' }}">
                                            <span class="text-danger error_text  youtube_error"></span>
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-12">
                                        <div>
                                            <label for="facebook" class="form-label">Facebook</label>
                                            <input type="text" class="form-control" name="facebook"
                                                   id="facebook" value="{{ $data ? $data->facebook : '' }}">
                                            <span class="text-danger error_text  facebook_error"></span>
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-12">
                                        <div>
                                            <label for="twitter" class="form-label">Twitter</label>
                                            <input type="text" class="form-control" name="twitter"
                                                   id="twitter" value="{{ $data ? $data->twitter : '' }}">
                                            <span class="text-danger error_text  twitter_error"></span>
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-12">
                                        <div>
                                            <label for="linkedin" class="form-label">Linkedin</label>
                                            <input type="text" class="form-control" name="linkedin"
                                                   id="linkedin" value="{{ $data ? $data->linkedin : '' }}">
                                            <span class="text-danger error_text  linkedin_error"></span>
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-12 mt-3">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Güncelle</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane" id="changeKatilim" role="tabpanel">
                            <form action="{{ route('settings.social.update') }}" method="POST" id="changeSocialForm">
                                @csrf
                                <div class="row g-2">
                                    @foreach ($cert as $certificate)
                                        @if ($certificate['certificate_value'] == 'kfullname')
                                            <div class="col-lg-12">
                                                <div>
                                                    <label for="kfullname" class="form-label">Kullanıcı İsim - Soyisim</label>
                                                    <input type="text" class="form-control" name="kfullname" id="kfullname"
                                                           placeholder="{{ $certificate['certificate_coord'] }}"
                                                           value="{{ old('kfullname', $certificate['certificate_coord']) }}">
                                                    <span class="text-danger error_text instagram_error"></span>
                                                </div>
                                            </div>
                                        @elseif ($certificate['certificate_value'] == 'keducationtime')
                                            <div class="col-lg-12">
                                                <div>
                                                    <label for="keducationtime" class="form-label">Eğitim Saati</label>
                                                    <input type="text" class="form-control" name="keducationtime" id="keducationtime"
                                                           placeholder="{{ $certificate['certificate_coord'] }}"
                                                           value="{{ old('keducationtime', $certificate['certificate_coord']) }}">
                                                    <span class="text-danger error_text youtube_error"></span>
                                                </div>
                                            </div>
                                        @elseif ($certificate['certificate_value'] == 'kcreatedtime')
                                            <div class="col-lg-12">
                                                <div>
                                                    <label for="kcreatedtime" class="form-label">Oluşturulma Zamanı</label>
                                                    <input type="text" class="form-control" name="kcreatedtime" id="kcreatedtime"
                                                           placeholder="{{ $certificate['certificate_coord'] }}"
                                                           value="{{ old('kcreatedtime', $certificate['certificate_coord']) }}">
                                                    <span class="text-danger error_text facebook_error"></span>
                                                </div>
                                            </div>
                                        @elseif ($certificate['certificate_value'] == 'kclassname')
                                            <div class="col-lg-12">
                                                <div>
                                                    <label for="kclassname" class="form-label">Sınıf Adı</label>
                                                    <input type="text" class="form-control" name="kclassname" id="kclassname"
                                                           placeholder="{{ $certificate['certificate_coord'] }}"
                                                           value="{{ old('kclassname', $certificate['certificate_coord']) }}">
                                                    <span class="text-danger error_text twitter_error"></span>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="col-lg-12 mt-3">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Güncelle</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!--end tab-pane-->
                        <div class="tab-pane" id="changeCustomSert" role="tabpanel">
                            <form action="{{ route('settings.social.updatecus') }}" method="POST"  id="changeSocialForm">
                                @csrf
                                <div class="row g-2">
                                    @foreach ($cert as $certificate)
                                        @if ($certificate['certificate_value'] == 'tfullname')
                                            <div class="col-lg-12">
                                                <div>
                                                    <label for="tfullname" class="form-label">Kullanıcı İsim - Soyisim</label>
                                                    <input type="text" class="form-control" name="tfullname" id="tfullname"
                                                           placeholder="130,105"
                                                           value="{{ old('tfullname', $certificate['certificate_coord']) }}">
                                                    <span class="text-danger error_text instagram_error"></span>
                                                </div>
                                            </div>
                                        @elseif ($certificate['certificate_value'] == 'teducationtime')
                                            <div class="col-lg-12">
                                                <div>
                                                    <label for="teducationtime" class="form-label">Eğitim Saati</label>
                                                    <input type="text" class="form-control" name="teducationtime" id="teducationtime"
                                                           placeholder="62,143"
                                                           value="{{ old('teducationtime', $certificate['certificate_coord']) }}">
                                                    <span class="text-danger error_text youtube_error"></span>
                                                </div>
                                            </div>
                                        @elseif ($certificate['certificate_value'] == 'tcreatedtime')
                                            <div class="col-lg-12">
                                                <div>
                                                    <label for="tcreatedtime" class="form-label">Oluşturulma Zamanı</label>
                                                    <input type="text" class="form-control" name="tcreatedtime" id="tcreatedtime"
                                                           placeholder="95,130"
                                                           value="{{ old('tcreatedtime', $certificate['certificate_coord']) }}">
                                                    <span class="text-danger error_text facebook_error"></span>
                                                </div>
                                            </div>
                                        @elseif ($certificate['certificate_value'] == 'tclassname')
                                            <div class="col-lg-12">
                                                <div>
                                                    <label for="tclassname" class="form-label">Sınıf Adı</label>
                                                    <input type="text" class="form-control" name="tclassname" id="tclassname"
                                                           placeholder="90,143"
                                                           value="{{ old('tclassname', $certificate['certificate_coord']) }}">
                                                    <span class="text-danger error_text twitter_error"></span>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="col-lg-12 mt-3">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Güncelle</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane" id="changemultilang" role="tabpanel">
                            <form action="{{ route('settings.social.updatetr') }}" method="POST"  id="changeSocialForm">
                                @csrf
                                <div class="row g-2">
                                    @foreach ($cert as $certificate)
                                        @if ($certificate['certificate_value'] == 'trfullname')
                                            <div class="col-lg-12">
                                                <div>
                                                    <label for="trfullname" class="form-label">Kullanıcı İsim - Soyisim</label>
                                                    <input type="text" class="form-control" name="trfullname" id="trfullname"
                                                           placeholder="125,95"
                                                           value="{{ old('trfullname', $certificate['certificate_coord']) }}">
                                                    <span class="text-danger error_text instagram_error"></span>
                                                </div>
                                            </div>
                                        @elseif ($certificate['certificate_value'] == 'trclassname')
                                            <div class="col-lg-12">
                                                <div>
                                                    <label for="trclassname" class="form-label">Sınıf Adı</label>
                                                    <input type="text" class="form-control" name="trclassname" id="trclassname"
                                                           placeholder="47,135"
                                                           value="{{ old('trclassname', $certificate['certificate_coord']) }}">
                                                    <span class="text-danger error_text twitter_error"></span>
                                                </div>
                                            </div>
                                        @elseif ($certificate['certificate_value'] == 'trclassnameeng')
                                            <div class="col-lg-12">
                                                <div>
                                                    <label for="trclassnameeng" class="form-label">Sınıf Adı İngilizce</label>
                                                    <input type="text" class="form-control" name="trclassnameeng" id="trclassnameeng"
                                                           placeholder="170,130"
                                                           value="{{ old('trclassnameeng', $certificate['certificate_coord']) }}">
                                                    <span class="text-danger error_text facebook_error"></span>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="col-lg-12 mt-3">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Güncelle</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>




@endsection


@section('addjs')

    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/sweetalerts.init.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/profile-setting.init.js') }}"></script>

    <script src="{{asset('backend/assets/libs/cleave.js/addons/cleave-phone.ve.js')}}"></script>
    <script src="{{asset('backend/assets/libs/cleave.js/cleave.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/pages/form-masks.init.js')}}"></script>
    <script>


        $(document).ready(function() {

            $('#changeSocialForm').on('submit', function(e) {
                e.preventDefault();
                var form = this;
                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: new FormData(form),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(form).find('span.error-text').text('');
                    },
                    success: function(data) {
                        if (data.code === 0) {
                            $.each(data.error, function(prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            toastr.success(data.msg, 'Başarılı');
                            $(form).find('span.error_text').text('');
                        }
                    }
                });

            });

            $('#changeContactForm').on('submit', function(e) {
                e.preventDefault();
                var form = this;
                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: new FormData(form),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(form).find('span.error-text').text('');
                    },
                    success: function(data) {
                        if (data.code === 0) {
                            $.each(data.error, function(prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            toastr.success(data.msg, 'Başarılı');
                            $(form).find('span.error_text').text('');
                        }
                    }
                });

            });

        });
    </script>
@endsection
