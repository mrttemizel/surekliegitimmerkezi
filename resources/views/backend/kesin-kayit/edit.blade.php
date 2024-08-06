@extends('backend.components.master')
@section('title')
    Kesin Kayıt Başvuru Düzenle
@endsection
@section('css')
    <link href="{{asset('backend/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link href="{{asset('backend/assets/libs/bootstrap-toogle/bootstrap-toggle.min.css')}}" rel="stylesheet"
          type="text/css"/>

    <style>

        .file-input-area {
            display: flex;
            flex-direction: column;
        }

    </style>

@endsection
@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Kesin Kayıt
        @endslot
        @slot('title')
            Kesin Kayıt Başvuruyu Düzenle
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
                    <i class="ri-check-double-line label-icon"></i><strong>  {{ session()->get('error') }}</strong></strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Başvuru Düzenle</h5>
                            <a href="{{ route('kesin-kayit-basvurulari.index') }}"
                               class="btn btn-primary waves-effect waves-light d-flex justify-content-between"><i
                                    class="ri-arrow-go-back-fill"></i> &nbsp; Geri Dön</a>

                        </div>
                        <div class="card-body">
                            <form action="{{route('kesin-kayit-basvurulari.update')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id }}">

                                <div class="live-preview">
                                    <div class="row gy-3">
                                        <div class="col-xl-6 col-md-6">
                                            <div>
                                                <label for="basiInput" class="form-label">Ad Soyad <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="name" placeholder="Ad Soyad"
                                                       class="form-control" value="{{ $data->name }}">
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
                                                <label for="basiInput" class="form-label">TC <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="tc" placeholder="TC"
                                                       class="form-control" value="{{ $data->tc }}">
                                                <span class="text-danger">
                                    @error('tc')
                                                    {{ $message }}
                                                    @enderror
                            </span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6">
                                            <div>
                                                <label for="labelInput" class="form-label">E-Posta <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="email" placeholder="E-Posta Adresi"
                                                       class="form-control" value="{{ $data->email }}">
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
                                                <label for="labelInput" class="form-label">Telefon <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="phone" class="form-control"
                                                       value="{{ $data->phone }}" id="cleave-phone"
                                                       placeholder="(xxx)xxx-xxxx">
                                                <span class="text-danger">
                                    @error('phone')
                                                    {{ $message }}
                                                    @enderror
                            </span>
                                            </div>
                                        </div>


                                        <div class="col-xl-12 col-md-12">
                                            <div>
                                                <label for="labelInput" class="form-label">Kayıt Olunan Eğitim <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" name="kurs_id"
                                                        aria-label="Default select example">
                                                    <option selected disabled>Eğitim Adı Seçiniz</option>
                                                    @foreach($courses as $course)
                                                        <option
                                                            value="{{$course->id}}" {{ $data->kurs_id == $course->id ? 'selected' : '' }}>{{$course->egitim_adi}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">
                                    @error('kurs_id')
                                                    {{ $message }}
                                                    @enderror
                                    </span>
                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="file-input-area">
                                                <label for="formFile" class="form-label">Kimlik</label>
                                                @if($data->kimlik)
                                                    <a href="{{ asset('kesin-kayit-evraklari/'.$data->kimlik) }}"
                                                       target="_blank" class="btn btn-info btn-sm mb-2"><i
                                                            class="ri-download-2-fill"></i> Yüklü Olan Belgeyi İndir</a>
                                                @else
                                                    <button class="btn btn-danger btn-sm mb-2"
                                                            style="pointer-events: none;">! Belge yüklenmemiş !
                                                    </button>
                                                @endif
                                                <input class="form-control" type="file" name="kimlik">
                                                Lütfen belgelerinizi "pdf" formatında yükleyiniz. Yükleyebileceğiniz dosya boyutu maksimum 2 MB dır. Hata almanız durumunda belgeleri tekrar yüklemelisiniz.

                                                <span class="text-danger">
                                    @error('image')
                                                    {{ $message }}
                                                    @enderror
                            </span>
                                            </div>
                                            <!-- end card -->
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="file-input-area">
                                                <label for="formFile" class="form-label">Diploma</label>
                                                @if($data->diploma)
                                                    <a href="{{ asset('kesin-kayit-evraklari/'.$data->diploma) }}"
                                                       target="_blank" class="btn btn-info btn-sm mb-2"><i
                                                            class="ri-download-2-fill"></i> Yüklü Olan Belgeyi İndir</a>
                                                @else
                                                    <button class="btn btn-danger btn-sm mb-2"
                                                            style="pointer-events: none;">! Belge yüklenmemiş !
                                                    </button>
                                                @endif <input class="form-control" type="file" name="diploma">
                                                Lütfen belgelerinizi "pdf" formatında yükleyiniz. Yükleyebileceğiniz dosya boyutu maksimum 2 MB dır. Hata almanız durumunda belgeleri tekrar yüklemelisiniz.

                                                <span class="text-danger">
                                    @error('image')
                                                    {{ $message }}
                                                    @enderror
                            </span>
                                            </div>
                                            <!-- end card -->
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="file-input-area">
                                                <label for="formFile" class="form-label">Kurum Karti</label>
                                                @if($data->kurumkarti)
                                                    <a href="{{ asset('kesin-kayit-evraklari/'.$data->kurumkarti) }}"
                                                       target="_blank" class="btn btn-info btn-sm mb-2"><i
                                                            class="ri-download-2-fill"></i> Yüklü Olan Belgeyi İndir</a>
                                                @else
                                                    <button class="btn btn-danger btn-sm mb-2"
                                                            style="pointer-events: none;">! Belge yüklenmemiş !
                                                    </button>
                                                @endif
                                                <input class="form-control" type="file" name="kurumkarti">
                                                Lütfen belgelerinizi "pdf" formatında yükleyiniz. Yükleyebileceğiniz dosya boyutu maksimum 2 MB dır. Hata almanız durumunda belgeleri tekrar yüklemelisiniz.
                                                <span class="text-danger">
                                    @error('image')
                                                    {{ $message }}
                                                    @enderror
                            </span>
                                            </div>
                                            <!-- end card -->
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="submit" class="btn btn-primary">Güncelle</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div>
    </div>


    <!-- Default Modals -->

@endsection

@section('addjs')

    <script src="{{ asset('backend/assets/libs/bootstrap-toogle/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/sweetalerts.init.js') }}"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <!--datatable js-->
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

@endsection

