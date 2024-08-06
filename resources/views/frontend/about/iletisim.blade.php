@extends('frontend.components.master')
@section('title')
    İletişim
@endsection

@section('addcss')
    <style>
        .back-input {
            position: relative;
            margin-bottom: 3rem; /* Boşluğu ayarlamak için */
        }

        .text-danger {
            color: #dc3545; /* Hata mesajı için kırmızı renk */
            font-size: 0.875rem; /* Yazı boyutunu ayarlamak için */
            display: block; /* Mesajın alt satıra geçmesini sağlamak için */
            margin-top: 0.25rem; /* Mesaj ile input arasında boşluk */
        }

        .react-contact-page .blog-form form input{
            margin-bottom: 0!important;
        }

        .react-contact-page .blog-form form textarea{
            margin-bottom: 0!important;
        }
    </style>
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
                                <h1 class="breadcrumbs-title">İletişim</h1>
                                <div class="back-nav">
                                    <ul>
                                        <li><a href="{{route('home.index')}}">Anasayfa</a></li>
                                        <li>İletişim</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--================= Breadcrumbs Section End Here =================-->
            <div id="react-contact" class="react-contact-page pt---100">
                <div class="container">
                    <div class="row pb---96">
                        <div class="col-lg-4 pt---10">
                            <ul class="address-sec">
                                @php
                                    // Metni al
                                    $address = $data->address;

                                    // Kelimeleri ayırmak için explode kullanın
                                    $words = explode(' ', $address);

                                    // Kelime gruplarını oluştur
                                    $chunks = array_chunk($words, 3);

                                    // İlk 3 kelime, ikinci 3 kelime vs.
                                    $lines = [];
                                    foreach ($chunks as $chunk) {
                                        $lines[] = implode(' ', $chunk);
                                    }
                                @endphp

                                <li>
                                    <em class="icon"><img src="{{asset('frontend/assets/images/contact/2.png')}}" alt="image"></em>
                                    <span class="text"><em>Adres</em>
                                        @foreach($lines as $line)
                                            {!! e($line) !!}<br>
                                        @endforeach
                                    </span>
                                </li>
                                <li>
                                    <em class="icon"><img src="{{asset('frontend/assets/images/contact/3.png')}}"
                                                          alt="image"></em>
                                    <span class="text"><em>İletişim</em> <a href="#">{{$data -> phonebir }}</a> <a
                                            href="#">Mail: {{$data->email}}</a></span>
                                </li>
                                <li>
                                    <em class="icon"><img src="{{asset('frontend/assets/images/contact/4.png')}}"
                                                          alt="image"></em>
                                    <span class="text"><em>Çalışma Saatleri</em> Pazartesi - Cuma: 08:30 - 17:30</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-8">
                            <!--================= Form Section Start Here =================-->
                            <div class="react-blog-form">
                                <h2 class="contact-title">Sorularınız mı var? <br> Bizimle iletişime geçmekten
                                    çekinmeyin.</h2>
                                <div id="blog-form" class="blog-form">
                                    <div id="form-messages"></div>
                                    <form id="contact-form" method="POST" action="{{route('hakkimizda_iletisim.sendMail')}}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="back-input">
                                                    <input id="file" type="text" name="name" placeholder="Ad Soyad">
                                                    <span class="text-danger">
                                    @error('name')
                                                        {{ $message }}
                                                        @enderror
                            </span>
                                                </div>

                                            </div>

                                            <div class="col-lg-6 pdl-5">
                                                <div class="back-input">
                                                    <input id="email" type="email" name="email" placeholder="E-Posta">
                                                    <span class="text-danger">
                                    @error('email')
                                                        {{ $message }}
                                                        @enderror
                            </span>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="back-input">
                                                    <input id="subject" type="text" name="subject" placeholder="Konu">
                                                    <span class="text-danger">
                                    @error('subject')
                                                        {{ $message }}
                                                        @enderror
                            </span>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 pdl-5">
                                                <div class="back-input">
                                                    <input id="phone" type="text" name="phone" placeholder="Telefon">
                                                    <span class="text-danger">
                                    @error('phone')
                                                        {{ $message }}
                                                        @enderror
                            </span>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="back-textarea">
                                                    <textarea id="message" name="message"
                                                              placeholder="Mesaj"></textarea>
                                                    <span class="text-danger">
                                    @error('message')
                                                        {{ $message }}
                                                        @enderror
                            </span>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <button type="submit" class="back-btn" id="submit-button">Gönder
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-arrow-right">
                                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                                        <polyline points="12 5 19 12 12 19"></polyline>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--================= Form Section End Here =================-->
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection


@section('addjs')
    <script>
        document.getElementById('contact-form').addEventListener('submit', function() {
            var submitButton = document.getElementById('submit-button');
            submitButton.innerHTML = 'Gönderiliyor...';
            submitButton.disabled = true;
        });
    </script>
@endsection
















