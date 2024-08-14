@extends('backend.components.master')
@section('title')
    Sınıflar
@endsection

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Sınıflar
        @endslot
        @slot('title')
            Sınıf Düzenle
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card ">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Sınıf Düzenle</h4>
                    <a href="{{ route('class.index') }}" class="btn btn-primary waves-effect waves-light d-flex justify-content-between"><i class="ri-arrow-go-back-fill"></i> &nbsp; Geri Dön</a>

                </div><!-- end card header -->
                <form action="{{ route('class.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-3">
                                <!-- Sınıf Adı -->
                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">Sınıf Adı<span class="text-danger"> *</span></label>
                                        <input type="text" name="sinif_adi" placeholder="Sınıf Adı" class="form-control" value="{{ old('sinif_adi', $data->sinif_adi) }}">
                                        <span class="text-danger">
                            @error('sinif_adi')
                                            {{ $message }}
                                            @enderror
                        </span>
                                    </div>
                                </div>
                                <!-- Başlangıç Tarihi -->
                                <div class="col-md-6">
                                    <div>
                                        <label class="form-label">Başlangıç Tarihi<span class="text-danger"> *</span></label>
                                        <input type="date" name="baslangic_tarihi" class="form-control" value="{{ old('baslangic_tarihi', $data->baslangic_tarihi) }}">
                                        <span class="text-danger">
                            @error('baslangic_tarihi')
                                            {{ $message }}
                                            @enderror
                        </span>
                                    </div>
                                </div>
                                <!-- Bitiş Tarihi -->
                                <div class="col-md-6">
                                    <div>
                                        <label class="form-label">Bitiş Tarihi<span class="text-danger"> *</span></label>
                                        <input type="date" name="bitis_tarihi" class="form-control" value="{{ old('bitis_tarihi', $data->bitis_tarihi) }}">
                                        <span class="text-danger">
                            @error('bitis_tarihi')
                                            {{ $message }}
                                            @enderror
                        </span>
                                    </div>
                                </div>
                                <!-- Eğitim -->
                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">Eğitim <span class="text-danger"> *</span></label>
                                        <select class="form-select" name="egitim_id" aria-label="Default select example">
                                            <option selected disabled>Eğitim Seçiniz</option>
                                            @foreach($courses as $course)
                                                <option value="{{ $course->id }}" {{ old('egitim_id', $data->egitim_id) == $course->id ? 'selected' : '' }}>{{ $course->egitim_adi }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">
                            @error('egitim_id')
                                            {{ $message }}
                                            @enderror
                        </span>
                                    </div>
                                </div>
                                <!-- Sertifika Tipi -->
                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">Sertifika - Katılım Belgesi Tipi <span class="text-danger"> *</span></label>
                                        <select class="form-select" name="sertifika_tipi" aria-label="Default select example">
                                            <option selected disabled>Sertifika Tipi Seçiniz</option>
                                            <option value="1" {{ old('sertifika_tipi', $data->sertifika_tipi) == 1 ? 'selected' : '' }}>Sertifika</option>
                                            <option value="2" {{ old('sertifika_tipi', $data->sertifika_tipi) == 2 ? 'selected' : '' }}>Katılım Belgesi</option>
                                        </select>
                                        <span class="text-danger">
                            @error('sertifika_tipi')
                                            {{ $message }}
                                            @enderror
                        </span>
                                    </div>
                                </div>
                                <!-- Sertifika Template -->

                                <div class="col-md-12">
                                    <div>
                                        <label for="image" class="form-label">Sertifika - Katılım Belgesi Template <span class="text-danger"> *</span></label>
                                        <input type="file" name="sertifika" class="form-control">
                                        <small class="form-text text-muted">Lütfen belgeyi "pdf" formatında yükleyiniz. Yükleyebileceğiniz dosya boyutu maksimum 2 MB'dır. Hata almanız durumunda belgeleri tekrar yüklemelisiniz.</small>
                                        <span class="text-danger">
                            @error('sertifika')
                                            {{ $message }}
                                            @enderror
                        </span>
                                    </div>
                                </div>
                                <!-- Sertifika İndir -->
                                <div class="col-md-12">
                                    <div>
                                        @if ($data->sertifika)
                                            <a href="{{ asset('sertifika_template/' . $data->sertifika) }}" target="_blank" class="btn btn-sm btn-danger mb-2 d-flex justify-content-center w-25"><i class="ri-download-2-fill"></i> İndir</a>
                                        @else
                                            <p>Sertifika yüklenmemiş</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">Sertifika - Katılım Belgesi Dili <span class="text-danger"> *</span></label>
                                        <select class="form-select" name="sertifika_dili" aria-label="Default select example">
                                            <option selected disabled>Sertifika - Katılım Belgesi Dili Seçiniz</option>
                                            <option value="1" {{ old('sertifika_dili', $data->sertifika_dili) == 1 ? 'selected' : '' }}>Türkçe</option>
                                            <option value="2" {{ old('sertifika_dili', $data->sertifika_dili) == 2 ? 'selected' : '' }}>İngilizce</option>
                                        </select>
                                        <span class="text-danger">
                            @error('sertifika_dili')
                                            {{ $message }}
                                            @enderror
                        </span>
                                    </div>
                                </div>
                                <!-- Submit Button -->
                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-primary">Güncelle</button>
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
