@extends('backend.components.master')
@section('title')
    Eğitimler
@endsection

@section('css')

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

@endsection

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Eğitimler
        @endslot
        @slot('title')
            Eğitim Ekle
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card ">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Eğitim Ekle</h4>
                    <a href="{{ route('courses.index') }}"
                       class="btn btn-primary waves-effect waves-light d-flex justify-content-between"><i
                            class="ri-arrow-go-back-fill"></i> &nbsp; Geri Dön</a>

                </div><!-- end card header -->
                <form action="{{route('courses.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-3">

                                <div class="col-md-6">
                                    <div>
                                        <label class="form-label">Eğitim Adı <span class="text-danger">*</span></label>
                                        <input type="text" name="egitim_adi" placeholder="Eğitim Adı"
                                               class="form-control" value="{{ old('egitim_adi') }}">
                                        <span class="text-danger">
                                    @error('egitim_adi')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label class="form-label">Eğitim Adı İngilizce <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="egitim_adi_ing" placeholder="Eğitim Adı İngilizce"
                                               class="form-control" value="{{ old('egitim_adi_ing') }}">
                                        <span class="text-danger">
                                    @error('egitim_adi_ing')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-md-6">
                                    <div>
                                        <label for="labelInput" class="form-label">Eğitim Kategorisi <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" name="category_id"
                                                aria-label="Default select example">
                                            <option selected disabled>Kategorisi Seçiniz</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">
                                    @error('category_id')
                                            {{ $message }}
                                            @enderror
                                    </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div>
                                        <label class="form-label">Eğitim Kordinatörü</label>
                                        <input type="text" name="egitim_kordinatorleri" placeholder="Eğitim Kordinatörü"
                                               class="form-control" value="{{ old('egitim_kordinatorleri') }}">
                                        <span class="text-danger">
                                    @error('egitim_kordinatorleri')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-md-6">
                                    <div>
                                        <label class="form-label">Eğitim Saati<span class="text-danger">*</span></label>
                                        <input type="text" name="egitim_saati" required placeholder="Eğitim Saati"
                                               class="form-control" value="{{ old('egitim_kordinatorleri') }}">
                                        <span class="text-danger">
                                    @error('egitim_saati')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-md-6">
                                    <div>
                                        <label class="form-label">Eğitim Başlangıç Tarihi </label>
                                        <input type="date" name="egitim_baslangic_tarihi"
                                               placeholder="Eğitim Başlangıç Tarihi" class="form-control"
                                               value="{{ old('egitim_baslangic_tarihi') }}">
                                        <span class="text-danger">
                                    @error('egitim_baslangic_tarihi')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-6">
                                    <div>
                                        <label class="form-label">Eğitim Bitiş Tarihi </label>
                                        <input type="date" name="egitim_bitis_tarihi" placeholder="Eğitim Bitiş Tarihi"
                                               class="form-control" value="{{ old('egitim_bitis_tarihi') }}">
                                        <span class="text-danger">
                                    @error('egitim_bitis_tarihi')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-md-6">
                                    <div>
                                        <label for="labelInput" class="form-label">Eğitim Platformu</label>
                                        <select class="form-select" name="egitim_platformu"
                                                aria-label="Default select example">
                                            <option selected disabled>Eğitim Platformu Seçiniz</option>
                                            <option value="Örgün">Örgün</option>
                                            <option value="Online">Online</option>
                                            <option value="Hibrit">Hibrit</option>
                                        </select>
                                        <span class="text-danger">
                                    @error('egitim_platformu')
                                            {{ $message }}
                                            @enderror
                                    </span>
                                    </div>
                                </div>

                                <!--end col-->

                                <div class="col-md-6">
                                    <div>
                                        <label class="form-label">Eğitim Yeri </label>
                                        <input type="text" name="egitim_yeri" placeholder="Eğitim Yeri"
                                               class="form-control" value="{{ old('egitim_yeri') }}">
                                        <span class="text-danger">
                                    @error('egitim_yeri')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-md-6">
                                    <div>
                                        <label class="form-label">Eğitici Adı </label>
                                        <input type="text" name="egitici_adi" placeholder="Eğitici Adı"
                                               class="form-control" value="{{ old('egitici_adi') }}">
                                        <span class="text-danger">
                                    @error('egitici_adi')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-md-6">
                                    <div>
                                        <label class="form-label">Eğitim Ücreti </label>
                                        <input type="text" name="egitim_ücreti" placeholder="Eğitim Ücreti"
                                               class="form-control" value="{{ old('egitim_ücreti') }}">
                                        <span class="text-danger">
                                    @error('egitim_ücreti')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-md-6">
                                    <div>
                                        <label class="form-label">Eğitim Katılım Şartı </label>
                                        <input type="text" name="egitim_katilim_sarti"
                                               placeholder="Eğitim Katılım Şartı" class="form-control"
                                               value="{{ old('egitim_katilim_sarti') }}">
                                        <span class="text-danger">
                                    @error('egitim_katilim_sarti')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-md-6">
                                    <div>
                                        <label class="form-label">Eğitim Kontenjanı </label>
                                        <input type="text" name="egitim_kontejyani" placeholder="Eğitim Kontejyanı"
                                               class="form-control" value="{{ old('egitim_kontejyani') }}">
                                        <span class="text-danger">
                                    @error('egitim_kontejyani')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->


                                <div class="col-md-6">
                                    <div>
                                        <label class="form-label">Eğitim Sırası</label>
                                        <input type="number" name="order" class="form-control"
                                               value="{{ old('order') }}">
                                        <span class="text-danger">
                                    @error('order')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class=" col-md-6">
                                    <div>
                                        <label for="image" class="form-label">Eğitim Görseli <span
                                                class="text-success fs-6">( Görsel Tam Ölçüleri <b>540x400 PX | Maksimum 4MB olmalıdır./b>  )</span></label>
                                        <input type="file" name="image" class="form-control">

                                        <span class="text-danger">
                                    @error('image')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-md-12 mb-3">
                                    <div>
                                        <label class="form-label">Eğitim Detay </label>
                                        <textarea name="detay" id="editor" class="form-control " rows="5"></textarea>
                                        <span class="text-danger">
                                    @error('egitim_kontejyani')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-12">
                                    <h5><b>Başvuru Formu</b></h5>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="on_basvuru"
                                               name="on_basvuru"
                                               value="on" {{ old('on_basvuru') === 'on' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="on_basvuru">
                                            Ön Başvuru Formu
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="kesin_kayit"
                                               name="kesin_kayit"
                                               value="on" {{ old('kesin_kayit') === 'on' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="kesin_kayit">
                                            Kesin Kayıt Formu
                                        </label>
                                        <span class="text-danger">
                                    @error('kesin_kayit')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>


                                <div class="col-md-12" id="additional-checkboxes" style="display: none;">
                                    <h6><b>Formda İstenilen Belgeler</b></h6>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="kimlik" name="kimlik">
                                        <label class="form-check-label" for="kimlik">
                                            Kimlik
                                        </label>
                                        <span class="text-danger">
                                    @error('kimlik')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="diploma" name="diploma">
                                        <label class="form-check-label" for="diploma">
                                            Diploma
                                        </label>
                                        <span class="text-danger">
                                    @error('diploma')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="kurumkarti"
                                               name="kurumkarti">
                                        <label class="form-check-label" for="kurumkarti">
                                            Kurum Kartı
                                        </label>
                                        <span class="text-danger">
                                    @error('kurumkarti')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('belgeler')
                                    {{ $message }}
                                    @enderror
                            </span>
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

    <script src="{{asset('backend/assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                // Editör ayarları
                toolbar: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    'blockQuote',
                    '|',
                    'undo',
                    'redo',
                    '|',
                    'insertTable'  // Tablo oluşturma düğmesi
                ],
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells',
                        'tableProperties',
                        'tableCellProperties'
                    ]
                }

            })
            .catch(error => {
                console.error(error);
            });
    </script>


    <script>
        document.getElementById('kesin_kayit').addEventListener('change', function () {
            var additionalCheckboxes = document.getElementById('additional-checkboxes');
            if (this.checked) {
                additionalCheckboxes.style.display = 'block';
            } else {
                additionalCheckboxes.style.display = 'none';
            }
        });

        // Formun ilk yüklenmesinde kesin_kayit checkbox'ı kontrol edilir
        document.addEventListener('DOMContentLoaded', function () {
            var kesinKayit = document.getElementById('kesin_kayit');
            var additionalCheckboxes = document.getElementById('additional-checkboxes');
            if (kesinKayit.checked) {
                additionalCheckboxes.style.display = 'block';
            }
        });
    </script>
@endsection
