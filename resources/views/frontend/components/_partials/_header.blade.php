<header id="react-header" class="react-header">
    <div class="topbar-area style1">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="topbar-contact">
                        <ul>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                <a href="tel:(+90)2422450000"> +90 242 245 00 00</a>
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                <a href="mailto:info@reactheme.com">sem@antalya.edu.tr</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-5 text-right">
                    <div class="toolbar-sl-share">
                        <ul class="social-links">
                            <li><a href="https://www.facebook.com/AntalyaSEM"><span aria-hidden="true" class="social_facebook"></span></a></li>
                            <li><a href="https://www.instagram.com/antalyasem/"><span aria-hidden="true" class="social_instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-part">
        <div class="container">
            <!--================= Menu Start Here =================-->
            <div class="react-main-menu">
                <nav>
                    <!--================= Menu Toggle btn =================-->
                    <div class="menu-toggle">
                        <div class="logo"><a href="{{route('home.index')}}" class="logo-text"> <img src="{{asset('backend/my-image/sem-ana.png')}}" alt="logo"> </a></div>
                        <button type="button" id="menu-btn">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!--================= Menu Structure =================-->
                    <div class="react-inner-menus">
                        <ul id="backmenu" class="react-menus home react-sub-shadow">
                            <li> <a href="{{route('home.index')}}">Anasayfa</a></li>
                            <li> <a href="{{route('tum_egitimler.index')}}">Eğitimler</a>
                                <ul>
                                    @foreach($categorys as $category)
                                    <li>
                                        <a href="{{route('tum_egitimler.showCategory',['id' => $category->id])}}">{{$category->name}}</a>
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                            <li> <a href="{{route('gallery.frontindex')}}">Galeri</a></li>
                            <li> <a href="#">Hakkımızda</a>
                                <ul>
                                    <li> <a href="{{route('hakkimizda_yonetim.index')}}">Yönetim</a></li>
                                    <li> <a href="{{route('hakkimizda_yonetim_kurulu.index')}}">Yönetim Kurulu</a></li>
                                    <li> <a href="{{route('hakkimizda_egitmenler.index')}}">Eğitmenler</a></li>
                                    <li> <a href="{{route('hakkimizda_formlar.index')}}">Formlar</a></li>
                                    <li> <a href="{{route('hakkimizda_is_birligi_yaptigimiz_kurumlar.index')}}">İş Birliği Yaptığımız Kurumlar</a></li>
                                    <li> <a href="{{route('hakkimizda_is_birligi_yaptigimiz_kurumlara_verilen_egitimler.index')}}">İş Birliği Yaptığımız Kurumlar İle ilgili Eğitimler</a></li>
                                    <li> <a href="{{route('hakkimizda_banka_hesap.index')}}">Banka Hesap Bilgileri</a></li>
                                    <li> <a href="{{route('education_request.index')}}">Eğitim İstek</a></li>
                                    <li> <a href="{{route('organization_chart.index')}}">Organizasyon Şeması</a></li>
                                    <li><a href="http://sikayet.antalya.edu.tr/portal" target="_blank">Şikayet Yönetim Sistemi</a></li>
                                    <li><a href="{{route('refund_form.index')}}">Ücret İadeleri İş Akışı ve Formları</a></li>
                                </ul>
                            </li>

                            <li> <a href="{{route('hakkimizda_iletisim.index')}}">İletişim</a></li>
                        </ul>
                        <div class="searchbar-part">
                            <form method="POST" action="{{ route('tum_egitimler.egitimAra') }}" class="search-form">
                                @csrf
                                <input type="text" name="search" placeholder="Eğitim Arayın..." value="{{old('search')}}">
                                <button> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg> </button>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
            <!--=================  Menu End Here  =================-->
        </div>
    </div>
</header>
