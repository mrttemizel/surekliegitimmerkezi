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
            Sınıf Ekle
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card ">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Sınıf Ekle</h4>
                    <a href="{{ route('class.index') }}" class="btn btn-primary waves-effect waves-light d-flex justify-content-between"><i class="ri-arrow-go-back-fill"></i> &nbsp; Geri Dön</a>

                </div><!-- end card header -->
                <form action="{{ route('class.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-3">
                                <!-- Sınıf Adı -->
                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">Sınıf Adı<span class="text-danger"> *</span></label>
                                        <input type="text" name="sinif_adi" placeholder="Sınıf Adı" class="form-control" value="{{ old('sinif_adi') }}">
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
                                        <input type="date" name="baslangic_tarihi" class="form-control" value="{{ old('baslangic_tarihi') }}">
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
                                        <input type="date" name="bitis_tarihi" class="form-control" value="{{ old('bitis_tarihi') }}">
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
                                            @foreach($data as $datas)
                                                <option value="{{ $datas->id }}" {{ old('egitim_id') == $datas->id ? 'selected' : '' }}>{{ $datas->egitim_adi }}</option>
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
                                            <option value="1" {{ old('sertifika_tipi') == 1 ? 'selected' : '' }}>Sertifika</option>
                                            <option value="2" {{ old('sertifika_tipi') == 2 ? 'selected' : '' }}>Katılım Belgesi</option>
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
                                        <select class="form-select" name="sertifika" aria-label="Default select example">
                                            <option selected disabled>Sertifika Templatini Seçiniz</option>
                                            <option value="katilim.pdf" {{ old('sertifika_tipi') == "katilim.pdf" ? 'selected' : '' }}>Katılım Belgesi</option>
                                            <option value="temel.pdf" {{ old('sertifika_tipi') == "temel.pdf" ? 'selected' : '' }}>Temel Sertifika</option>
                                            <option value="tr-eng.pdf" {{ old('sertifika_tipi') == "tr-eng.pdf" ? 'selected' : '' }}>TR-ENG Sertifika Belgesi</option>
                                        </select>
                                       <!-- <input type="file" name="sertifika" class="form-control">
                                        <small class="form-text text-muted">Lütfen belgeyi "pdf" formatında yükleyiniz. Yükleyebileceğiniz dosya boyutu maksimum 2 MB'dır. Hata almanız durumunda belgeleri tekrar yüklemelisiniz.</small>-->
                                        <span class="text-danger">
                            @error('sertifika')
                                            {{ $message }}
                                            @enderror
                        </span>
                                    </div>
                                </div>
                                <!-- Sertifika Dili -->
                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">Sertifika - Katılım Belgesi Dili <span class="text-danger"> *</span></label>
                                        <select class="form-select" name="sertifika_dili" aria-label="Default select example">
                                            <option selected disabled>Sertifika - Katılım Belgesi Dili Seçiniz</option>
                                            <option value="1" {{ old('sertifika_dili') == 1 ? 'selected' : '' }}>Türkçe</option>
                                            <option value="2" {{ old('sertifika_dili') == 2 ? 'selected' : '' }}>İngilizce</option>
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

