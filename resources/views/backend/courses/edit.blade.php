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
            Eğitim Düzenle
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card ">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">{{ $data-> egitim_adi}} -  Düzenle</h4>
                    <a href="{{ route('courses.index') }}" class="btn btn-primary waves-effect waves-light d-flex justify-content-between"><i class="ri-arrow-go-back-fill"></i> &nbsp; Geri Dön</a>

                </div><!-- end card header -->
                <form action="{{route('courses.update')}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="{{$data->id}}">
                    @csrf
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-3">

                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">Eğitim Adı <span class="text-danger">*</span></label>
                                        <input type="text" name="egitim_adi" placeholder="Eğitim Adı" class="form-control" value="{{ $data-> egitim_adi}}">
                                        <span class="text-danger">
                                    @error('egitim_adi')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-md-6">
                                    <div>
                                        <label for="labelInput" class="form-label">Eğitim Kategorisi <span class="text-danger">*</span></label>
                                        <select class="form-select" name="category_id"  aria-label="Default select example">
                                            <option disabled>Kategorisi Seçiniz</option>
                                            @foreach($categories as $category)
                                                <option @if($data->category_id == $category->id) selected @endif  value="{{$category->id}}">{{$category->name}}</option>
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
                                        <input type="text" name="egitim_kordinatorleri" placeholder="Eğitim Kordinatörü" class="form-control" value="{{ $data-> egitim_kordinatorleri}}">
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
                                        <label class="form-label">Eğitim Saati</label>
                                        <input type="text" name="egitim_saati" placeholder="Eğitim Saati" class="form-control" value="{{ $data-> egitim_saati }}">
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
                                        <input type="date" name="egitim_baslangic_tarihi" placeholder="Eğitim Başlangıç Tarihi" class="form-control" value="{{ $data-> egitim_baslangic_tarihi }}">
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
                                        <input type="date" name="egitim_bitis_tarihi" placeholder="Eğitim Bitiş Tarihi" class="form-control" value="{{ $data-> egitim_bitis_tarihi }}">
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
                                        <select class="form-select" name="egitim_platformu"  aria-label="Default select example">
                                            <option selected disabled>Eğitim Platformu Seçiniz</option>
                                            <option value="Örgün" {{ old('egitim_platformu', $data->egitim_platformu ?? '') == 'Örgün' ? 'selected' : '' }}>Örgün</option>
                                            <option value="Online" {{ old('egitim_platformu', $data->egitim_platformu ?? '') == 'Online' ? 'selected' : '' }}>Online</option>
                                            <option value="Hibrit" {{ old('egitim_platformu', $data->egitim_platformu ?? '') == 'Hibrit' ? 'selected' : '' }}>Hibrit</option>
                                        </select>
                                        <span class="text-danger">
                                    @error('egitim_platformu')
                                            {{ $message }}
                                            @enderror
                                    </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div>
                                        <label class="form-label">Eğitim Yeri </label>
                                        <input type="text" name="egitim_yeri" placeholder="Eğitim Yeri" class="form-control" value="{{ $data-> egitim_yeri }}">
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
                                        <input type="text" name="egitici_adi" placeholder="Eğitici Adı" class="form-control" value="{{ $data-> egitici_adi }}">
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
                                        <input type="text" name="egitim_ücreti" placeholder="Eğitim Ücreti" class="form-control" value="{{ $data-> egitim_ücreti }}">
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
                                        <input type="text" name="egitim_katilim_sarti" placeholder="Eğitim Katılım Şartı" class="form-control" value="{{ $data-> egitim_katilim_sarti }}">
                                        <span class="text-danger">
                                    @error('egitim_katilim_sarti')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">Eğitim Kontejyanı </label>
                                        <input type="text" name="egitim_kontejyani" placeholder="Eğitim Kontejyanı" class="form-control" value="{{ $data-> egitim_kontejyani }}">
                                        <span class="text-danger">
                                    @error('egitim_kontejyani')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-md-12">
                                    <div>
                                        <!-- Thumbnails Images -->
                                        <img src="{{ asset('courses/'.$data->image)}}" alt="" class="img-thumbnail avatar-xl">
                                        <label for="image" class="form-label">Eğitim Görseli  <span class="text-success fs-6">( Görsel Tam Ölçüleri <b>540x400 PX</b>  )</span></label>
                                        <input type="file" name="image"  class="form-control">

                                        <span class="text-danger">
                                    @error('image')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">Eğitim Detay </label>
                                        <textarea name="detay" id="editor" class="form-control " rows="5">{!!$data->detay!!}</textarea>
                                        <span class="text-danger">
                                    @error('egitim_kontejyani')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-md-12">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="formCheck6" name="status" {{ $data->status == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="formCheck6">
                                            Aktif
                                        </label>
                                    </div>

                                </div>



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
@endsection
