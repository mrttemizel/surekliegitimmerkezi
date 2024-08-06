@extends('frontend.components.master')
@section('title')
    Tüm Eğitimler
@endsection

@section('addcss')

    <style>

        .inner-course{
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            display: flex;
            flex-direction: column;
            height: 100%; /* Kartın yüksekliği, içeriğe bağlı olarak ayarlanır */
            overflow: hidden; /* Taşmayı önler */
        }


        .case-img img {
            width: 100%; /* Görselin genişliğini kapsayıcıya göre ayarlar */
            height: auto; /* Görsel yüksekliğini orantılı olarak ayarlar */
            padding: 10px;
        }


        .case-content {
            flex: 1; /* İçeriğin kalan alanı kaplamasına izin verir */
            display: flex;
            flex-direction: column;
            padding: 15px;
        }


        .case-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background-color: #f9f9f9; /* Arka plan rengi */
            margin-top: auto; /* Bu öğeyi altta sabitler */
        }

        .li-category-item{
            font-size: 15px!important;
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
                                <h1 class="breadcrumbs-title">Tüm Eğitimler</h1>
                                <div class="back-nav">
                                    <ul>
                                        <li><a href="{{route('home.index')}}">Anasayfa</a></li>
                                        <li>Tüm Eğitimler</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--================= Breadcrumbs Section End Here =================-->

            <!--================= Course Filter Section Start Here =================-->

            <div class="react-course-filter back__course__page_grid back__course__page_grid_left pb---40 pt---100">
                <div class="container pb---70">
                    <div class="row">
                        <div class="col-lg-12>
                            <div class="row align-items-center back-vertical-middle shorting__courses3">
                                <div class="col-md-6">
                                    <div class="all__icons">
                                        <div class="result-count">
                                            Toplam Bulunan Kurs Sayısı:
                                            {{ $data->filter(function($course) { return $course->status == 1; })->count() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach($data as $datas)
                                    <div class="single-studies col-lg-3 grid-item">
                                        <div class="inner-course">
                                            <div class="case-img">
                                                <img src="{{asset('courses/'.$datas->image)}}" alt="Course Image">
                                            </div>
                                            <div class="case-content">
                                                <h4 class="case-title"> <a href="{{route('egitim_detay.index', ['slug' => $datas->slug])}}">{{$datas->egitim_adi}}</a></h4>
                                                <ul class="meta-course">
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg> {{$datas->egitim_platformu}} </li>
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> {{$datas->egitim_saati}}</li>
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> {{$datas->egitim_kontejyani}} </li>
                                                </ul>

                                                <ul class="react-ratings">
                                                    <li class="price">{{$datas->egitim_ücreti}}</li>
                                                    <a href="{{route('egitim_detay.index', ['slug' => $datas->slug])}}" class="btn btn-danger">İncele</a>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!--================= Pagination Section End Here =================-->
                        </div>
                    </div>
                </div>
            </div>

            <!--================= Course Filter Section End Here =================-->

        </div>
    </div>
    <!--================= Wrapper End Here =================-->






@endsection
