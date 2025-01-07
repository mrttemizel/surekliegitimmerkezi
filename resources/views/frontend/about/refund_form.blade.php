@extends('frontend.components.master')
@section('title')
    Ücret İade Formları Sayfası
@endsection

@section('addcss')

@endsection


@section('content')

    <div class="react-wrapper">
        <div class="react-wrapper-inner">
            <!--================= Breadcrumbs Section Start Here =================-->
            <div class="react-breadcrumbs">
                <div class="breadcrumbs-wrap">
                    <img class="desktop" src="{{asset('frontend/assets/images/yonetim.jpg')}}" alt="Breadcrumbs">
                    <img class="mobile" src="{{asset('frontend/assets/images/yonetim.jpg')}}" alt="Breadcrumbs">
                    <div class="breadcrumbs-inner">
                        <div class="container">
                            <div class="breadcrumbs-text">
                                <h1 class="breadcrumbs-title">Ücret İade Formları Sayfası</h1>
                                <div class="back-nav">
                                    <ul>
                                        <li><a href="{{route('home.index')}}">Anasayfa</a></li>
                                        <li>Ücret İade Formları Sayfası</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--================= Breadcrumbs Section End Here =================-->
            <div class="react-upcoming__event react-upcoming__event_page blog__area pt---100 pb---112">
                <div class="container">
                    <div class="row align-items-center back-vertical-middle shorting__course3 mb-50">
                        <div class="col-md-6">
                            <div class="all__icons">
                                <div class="result-count">Aşağıdaki bağlantılardan tüm formlara kolayca
                                    ulaşabilirsiniz.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($data as $datas)
                            <div class="col-lg-4">
                                <div class="event__card">
                                    <div class="event__card--content">
                                        <div class="event__card--content-area">
                                            <h5 class="event__card--title">{{$datas->name}}</h5>
                                            <a class="event__card--link mt-3" href="{{asset('formlar/'.$datas->file)}}"
                                               target="_blank"> İndir
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-arrow-right">
                                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                                    <polyline points="12 5 19 12 12 19"></polyline>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection






































