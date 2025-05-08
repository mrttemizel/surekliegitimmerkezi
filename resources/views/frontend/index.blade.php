@php
    use Carbon\Carbon;
    Carbon::setLocale('tr'); // Set the locale to Turkish
@endphp

@extends('frontend.components.master')
@section('title')
    Anasayfa
@endsection


@section('addcss')

    <style>


        .course__item {
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px !important;
            display: flex;
            flex-direction: column;
            height: 100%; /* Kartın yüksekliği, içeriğe bağlı olarak ayarlanır */
            overflow: hidden; /* Taşmayı önler */
        }


        .course__thumb img {
            width: 100%; /* Görselin genişliğini kapsayıcıya göre ayarlar */
            height: auto; /* Görsel yüksekliğini orantılı olarak ayarlar */
            padding: 10px;
        }


        .course__inner {
            flex: 1; /* İçeriğin kalan alanı kaplamasına izin verir */
            display: flex;
            flex-direction: column;
            padding: 15px;
        }


        .course__card-icon {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background-color: #f9f9f9; /* Arka plan rengi */
            margin-top: auto; /* Bu öğeyi altta sabitler */
        }


    </style>
@endsection

@section('content')

    <div class="react-wrapper">
        <div class="react-wrapper-inner">

            <!--================= Slider Section Start Here =================-->
            <div class="react-slider-part">
                <div class="home-sliders home2 owl-carousel">
                    @foreach($slider as $sliders)
                        <div class="single-slide">
                            <div class="slider-img">
                                <img class="desktop" src="{{'slider/'.$sliders->image}}" alt="Slider Image 1">
                                <img class="mobile" src="{{'slider/'.$sliders->image_mobil}}" alt="Slider Image 1">
                            </div>
                            <div class="container">
                                <div class="slider-content">
                                    <div class="content-part">
                                        <span class="slider-pretitle">{{$sliders->slider_ust_baslik}}</span>
                                        @php
                                            $words = explode(' ', $sliders->slider_aciklama);

                                            $firstPart = implode(' ', array_slice($words, 0, 13));
                                            $secondPart = implode(' ', array_slice($words, 13, 13));
                                            $thirdPart = implode(' ', array_slice($words, 20));
                                        @endphp

                                        <p class="slider-title"
                                           style="font-size: 18px; line-height: 1.7; margin: 0; padding: 10px;">
                                            {{$firstPart}} <br>
                                            {{$secondPart}}<br>
                                            {{$thirdPart}}

                                        </p>


                                        @if(!empty($sliders->slider_button_link))
                                            <div class="slider-btn">
                                                <a href="{{ $sliders->slider_button_link }}" class="react-btn-border">Admissions</a>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                                @if(!empty($sliders->slider_video_link))
                                    <div class="event__video-btn--play">
                                        <a href="{{ $sliders->slider_video_link }}"
                                           class="event__video-btn--play-btn custom-popup">
                                            <i class="arrow_triangle-right"></i>
                                            <em>Tanıtım<br>Videosu</em>
                                        </a>
                                    </div>
                                @endif

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!--================= Slider Section End Here =================-->

            <!--================= Popular Course Section Start Here =================-->
            <div class="popular__course__area pt---100 pb---100">
                <div class="container">
                    <div class="react__title__section text-center">
                        <h2 class="react__tittle">Eğitimler</h2>
                        <img src="{{asset('frontend/assets/images/line.png')}}" alt="image">
                    </div>
                    <div class="row">
                        @foreach($courses as $course)
                            <div class="col-lg-3">
                                <div class="course__item mb-30">
                                    <div class="top-course">

                                    </div>
                                    <div class="course__thumb">
                                        <a href="{{route('egitim_detay.index', ['slug' => $course->slug])}}"><img
                                                src="{{ $course->image ? asset('courses/'.$course->image) : asset('courses/no_name.jpg') }}"
                                                style="width: 300px; height: 300px" alt="image"></a>
                                    </div>

                                    <div class="course__inner">
                                        <ul>
                                            <li>{{$course->egitim_platformu}}</li>
                                            <li>{{$course->egitim_saati}}</li>
                                            <li>{{Carbon::parse($course->egitim_baslangic_tarihi)->format('d-m-Y')}}</li>

                                        </ul>
                                        <h3 class="react-course-title"><a
                                                href="{{route('egitim_detay.index', ['slug' => $course->slug])}}">{{$course->egitim_adi}}</a>
                                        </h3>

                                        <div class="course__card-icon d-flex align-items-center">
                                            <div class="course__card-icon--1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-users">
                                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="9" cy="7" r="4"></circle>
                                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                                </svg>
                                                <span> {{$course->egitim_kontejyani}} Kişi</span>
                                            </div>
                                            <div class="react__user">
                                                {{$course->egitim_ücreti}}
                                            </div>
                                            <a href="{{route('egitim_detay.index', ['slug' => $course->slug])}}"
                                               class="btn btn-sm btn-danger">İncele</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center">
                        <a href="{{route('tum_egitimler.index')}}" class="view-courses"> Tüm Eğitimleri Görüntüle
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-arrow-right">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <!--================= Popular Course Section End Here =================-->

            <!--================= Upcoming Event Section Start Here =================-->
            <div class="react-upcoming__event blog__area">
                <div class="container">
                    <div class="react__title__section text-center">
                        <h2 class="react__tittle">Yaklaşan Eğitimler</h2>
                        <img src="{{asset('frontend/assets/images/line.png')}}" alt="image">
                    </div>
                    <div class="event-slider owl-carousel">
                        @foreach($courses_nows as $courses_now)
                            <div class="event__card">
                                <div class="event__card--content">
                                    <div class="event__card--content-area">
                                        <div class="event__card--date">
                                            <em>{{ Carbon::parse($courses_now->egitim_baslangic_tarihi)->format('d') }}</em>
                                            {{ Carbon::parse($courses_now->egitim_baslangic_tarihi)->translatedFormat('F, Y')  }}
                                        </div>
                                        <div
                                            class="event_time">{{ Carbon::parse($courses_now->egitim_baslangic_tarihi)->format('d-m-Y') }}
                                            - {{ Carbon::parse($courses_now->egitim_bitis_tarihi)->format('d-m-Y') }}</div>
                                        <h3 class="event__card--title"><a
                                                href="{{route('egitim_detay.index', ['slug' => $courses_now->slug])}}">{{$courses_now->egitim_adi}}</a>
                                        </h3>

                                        <div class="event_location">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-map-pin">
                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                <circle cx="12" cy="10" r="3"></circle>
                                            </svg>
                                            {{$courses_now->egitim_yeri}}</div>
                                        <a class="event__card--link"
                                           href="{{route('egitim_detay.index', ['slug' => $course->slug])}}"> İncele
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-arrow-right">
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                                <polyline points="12 5 19 12 12 19"></polyline>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!--================= Upcoming Event Section End Here =================-->


            <!--
             =================  Service Section Start Here =================
            <div class="react_popular_topics pt---100 pb---70">
                <div class="container">
                    <div class="react__title__section text-left">
                        <h2 class="react__tittle">Academics</h2>
                        <img src="{{asset('frontend/assets/images/line.png')}}" alt="image">
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="item__inner">
                                <div class="icon">
                                    <img src="{{asset('frontend/assets/images/service/1.png')}}" alt="image">
                                </div>
                                <div class="react-content">
                                    <h3 class="react-title"><a href="coureses-grid.html">Let’s Talk Science</a></h3>
                                    <a href="#" class="r__link">Learn More <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="item__inner">
                                <div class="icon">
                                    <img src="{{asset('frontend/assets/images/service/2.png')}}" alt="image">
                                </div>
                                <div class="react-content">
                                    <h3 class="react-title"><a href="coureses-grid.html">Innovative Courses</a></h3>
                                    <a href="#" class="r__link">Learn More <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="item__inner">
                                <div class="icon">
                                    <img src="{{asset('frontend/assets/images/service/3.png')}}" alt="image">
                                </div>
                                <div class="react-content">
                                    <h3 class="react-title"><a href="coureses-grid.html">Cloud Storage</a></h3>
                                    <a href="#" class="r__link">Learn More <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="item__inner">
                                <div class="icon">
                                    <img src="{{asset('frontend/assets/images/service/4.png')}}" alt="image">
                                </div>
                                <div class="react-content">
                                    <h3 class="react-title"><a href="coureses-grid.html">Online Education</a></h3>
                                    <a href="#" class="r__link">Learn More <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            =================  Service Section End Here ================= -->

            <!--=================  About Section Start Here ================= -->
            <div class="about__area about__area_one p-relative pt---10 pb---120">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="about__image">
                                <img src="{{asset('backend/my-image/sem.png')}}" alt="About">
                                <img class="react__shape__ab" src="{{asset('backend/my-image/abu-renkli.svg')}}" width="350px"
                                     alt="Shape Image">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="about__content">
                                <h2 class="about__title">HOŞGELDİNİZ <br> <em>SÜREKLİ EĞİTİM UYGULAMA VE ARAŞTIRMA
                                        MERKEZİ</em></h2>
                                <p class="about__paragraph">Antalya Bilim Üniversitesi Sürekli Eğitim Uygulama ve Araştırma Merkezi olarak
                                    planladığımız ve açtığımız Eğitimleri bireylerin kişisel gelişimine yardımcı olmak, işe
                                    hazırlamak, meslek edinmelerine yardım etmek ve kariyer hedeflerine ulaşmayı
                                    amaçlamaktayız.</p>
                                <p class="about__paragraph">Antalya SEM, çeşitli alanlarda sunmuş olduğu kapsamlı eğitim programları
                                    ile bireyin kendini geliştirmesine olanak tanır. Uzman kadromuz, dinamik müfredatlarımız
                                    ve modern eğitim olanaklarımız sayesinde, katılımcılarımıza en güncel bilgileri
                                    sunmaktayız. Sürekli Eğitim Merkezi, katılımcılarının kendilerini geliştirmesinin yanı
                                    sıra, iş dünyasında rekabet avantajı sağlamalarına da destek olmaktadır.</p>

                                <p class="about__paragraph2"> Daha fazla
                                    bilgi almak ve kayıt olmak için web sitemizi ziyaret edebilir veya bizimle iletişime
                                    geçebilirsiniz.</p>

                                <ul>
                                    <li><a href="{{route('hakkimizda_iletisim.index')}}" class="more-about"> İletişim
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-arrow-right">
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                                <polyline points="12 5 19 12 12 19"></polyline>
                                            </svg>
                                        </a></li>
                                    <li class="last-li">
                                        <em>E-Posta</em>
                                        <a href="mailto:sem@antalya.edu.tr">sem@antalya.edu.tr</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--================= About Section End Here ================= -->


            <!--================= Counter Section Start Here =================-->
            <div class="count__area pb---110">
                <div class="container count__width">
                    <div class="row">
                        <div class="col-xxl-11 col-xl-11 col-lg-11 offset-lg-1">
                            <div class="row">
                                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                    <div class="count__content">
                                        <p class="count__content--paragraph">Kursiyer <br>Sayısı</p>
                                        <h3 class="count__content--title-1 counter">18.841</h3>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                    <div class="count__content">
                                        <p class="count__content--paragraph">Toplam Ders <br>Saati</p>
                                        <h3 class="count__content--title-1 counter">42.994</h3>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                    <div class="count__content">
                                        <p class="count__content--paragraph">Eğitmen<br>Sayısı</p>
                                        <h3 class="count__content--title-1 counter">172</h3>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                    <div class="count__content">
                                        <p class="count__content--paragraph">Memnuniyet <br>Oranı</p>
                                        <h3 class="count__content--title-1 counter">95</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--================= Counter Section End Here =================-->


        </div>
    </div>

@endsection
