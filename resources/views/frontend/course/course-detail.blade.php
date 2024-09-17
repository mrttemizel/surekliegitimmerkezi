@extends('frontend.components.master')
@section('title') {{$data->egitim_adi}}  @endsection

@section('addcss')

    <style>
        .react-sidebar .widget.get-back-course .start-btn
        {
            margin-top: 5px;
            margin-bottom: 5px;
        }
    </style>

@endsection

@section('content')


    <div class="react-wrapper">
        <div class="react-wrapper-inner">
            <!--================= Breadcrumbs Section Start Here =================-->
            <div class="react-breadcrumbs">
                <div class="breadcrumbs-wrap">

                    <img class="desktop" src="{{asset('frontend/assets/images/egitimler.jpg')}}" alt="Breadcrumbs">
                    <img class="mobile" src="{{asset('frontend/assets/images/egitimler.jpg')}}" alt="Breadcrumbs">

                    <div class="breadcrumbs-inner">
                        <div class="container">
                            <div class="breadcrumbs-text">
                                <h1 class="breadcrumbs-title">{{$data -> egitim_adi }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--================= Breadcrumbs Section End Here =================-->

            <!--================= Course Filter Section Start Here =================-->
            <div class="back__course__page_grid react-courses__single-page pb---16 pt---110">
                <div class="container pb---70">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="course-single-tab">

                                <div class="tab-content" id="back-tab-content">
                                    <div class="tab-pane fade show active" id="discription" role="tabpanel" aria-labelledby="discription">
                                        <h3>{{$data -> egitim_adi }}</h3>
                                        {!! $data -> detay !!}

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 md-mt-60">
                            <div class="react-sidebar react-back-course2 ml----30">
                                <div class="widget get-back-course">
                                    <ul class="price">
                                        <li>{{$data -> egitim_ücreti }}</li>
                                    </ul>
                                    <ul class="price__course">
                                        <li> <i class="icon_profile"></i> Eğitici Adı <b>{{$data -> egitici_adi }}</b></li>
                                        <li><i class="icon_tag_alt"></i> Eğitim Platformu <b>{{$data -> egitim_platformu }}</b></li>
                                        <li> <i class="icon_clock_alt"></i> Eğitim Saati <b>{{$data -> egitim_saati }}</b></li>
                                        <li><i class="icon_clock_alt"></i> Eğitim Kontejyanı <b>{{$data -> egitim_kontejyani }}</b></li>
                                        <li><i class="icon_map_alt"></i> Eğitim Yeri <b> {{$data -> egitim_yeri }}</b></li>
                                    </ul>
                                    <div class="d-flex flex-column justify-content-between" style="width: 100%">
                                        @if($data->kesin_kayit == 'on')
                                            @if($studentCount >= $data->egitim_kontejyani)
                                                <a href="javascript:void(0)" class="start-btn disabled" style="background: gray; cursor: not-allowed;">
                                                    Kontenjan Dolu
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                                        <polyline points="12 5 19 12 12 19"></polyline>
                                                    </svg>
                                                </a>
                                            @else
                                                <a href="{{route('form.kesin-kayit-form',['slug' => $data->slug])}}" class="start-btn" style="background: #d2093c">
                                                    Kesin Kayıt
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                                        <polyline points="12 5 19 12 12 19"></polyline>
                                                    </svg>
                                                </a>
                                            @endif
                                        @endif
                                            @if($data->on_basvuru == 'on')
                                                <a href="{{route('form-kayit-on.form-kayit-form',['slug' => $data->slug])}}" class="start-btn">Ön Başvuru
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                                        <polyline points="12 5 19 12 12 19"></polyline>
                                                    </svg>
                                                </a>
                                            @endif
                                    </div>
                                </div>
                                <div class="widget react-categories-course">
                                    <h3 class="widget-title">Kurs Kategorileri</h3>
                                    <ul class="recent-category">
                                        @foreach($category as $categorys)
                                            <li> <a href="{{route('tum_egitimler.showCategory',['id' => $categorys->id])}}">{{ $categorys->name ?? 'Değer girişmemiş' }} ({{ $categorys->courseCount() }})</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--================= Course Filter Section End Here =================-->

        </div>
    </div>




@endsection
