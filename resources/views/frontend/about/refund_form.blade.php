

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

            <div class="instructors___page pt---120 pb---140">
                <div class="container pb---60">
                    <div class="row">

                        {!! $data->pagecontent ?? 'Değer Girilmemiş' !!}
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection



















