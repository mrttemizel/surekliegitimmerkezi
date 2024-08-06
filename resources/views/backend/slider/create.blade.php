@extends('backend.components.master')
@section('title')
    Slider
@endsection

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Slider
        @endslot
        @slot('title')
            Slider Ekle
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card ">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Slider Ekle</h4>
                    <a href="{{ route('slider.index') }}" class="btn btn-primary waves-effect waves-light d-flex justify-content-between"><i class="ri-arrow-go-back-fill"></i> &nbsp; Geri Dön</a>

                </div><!-- end card header -->
                <form action="{{route('slider.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-3">
                                <div class=" col-md-12">
                                    <div>
                                        <label for="image" class="form-label">Slider Görsel <span class="text-danger">*</span><br> <span class="text-danger">- Ölçüler 1920x770 px olmalıdır!<br>- Yükleyebileceğiniz maksimum dosya boyutu 3 MB'dır.</span></label>
                                        <input type="file" name="image"  class="form-control">
                                        <span class="text-danger">
                                    @error('image')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class=" col-md-12">
                                    <div>
                                        <label for="image" class="form-label">Slider Mobil Görsel <span class="text-danger">*</span><br> <span class="text-danger">- Ölçüler 991x770 px olmalıdır!<br>- Yükleyebileceğiniz maksimum dosya boyutu 3 MB'dır.</span></label>
                                        <input type="file" name="image_mobil"  class="form-control">
                                        <span class="text-danger">
                                    @error('image_mobil')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">Slider Üst Başlık</label>
                                        <input type="text" name="slider_ust_baslik" placeholder="Slider Üst Başlık" class="form-control" value="{{ old('slider_ust_baslik') }}">
                                        <span class="text-danger">
                                    @error('slider_ust_baslik')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">Slider Açıklama </label>
                                        <input type="text" name="slider_aciklama" placeholder="Slider Açıklama" class="form-control" value="{{ old('slider_aciklama') }}">
                                        <span class="text-danger">
                                    @error('slider_aciklama')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">Slider Button Link </label>
                                        <input type="text" name="slider_button_link" placeholder="Slider Button Link" class="form-control" value="{{ old('slider_button_link') }}">
                                        <span class="text-danger">
                                    @error('slider_button_link')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">Slider Video Link </label>
                                        <input type="text" name="slider_video_link" placeholder="Slider Video Link" class="form-control" value="{{ old('slider_video_link') }}">
                                        <span class="text-danger">
                                    @error('slider_video_link')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->




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

