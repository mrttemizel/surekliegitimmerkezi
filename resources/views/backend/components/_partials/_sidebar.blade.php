@php use Illuminate\Support\Facades\Route; @endphp
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">

        <!-- Light Logo-->
        <a href="#" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('backend/my-image/abu-beyaz-dikey.svg')}}" alt="" height="40">
                    </span>
            <span class="logo-lg">
                        <img src="{{asset('backend/my-image/abu-beyaz.svg')}}" alt="" height="40">
                    </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                @php
                    $currentRoute = Route::currentRouteName();
                @endphp

                <li class="nav-item">
                    <a class="nav-link menu-link {{ $currentRoute == 'auth.index' ? 'active' : '' }}" href="{{ route('auth.index') }}">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li> <!-- end Dashboard Menu -->


                <li class="nav-item">
                    @php
                        $coursesRoutes = ['class.list','class.old-list'];
                    @endphp
                    <a class="nav-link menu-link {{ in_array($currentRoute, $coursesRoutes) ? 'active' : '' }}" href="#sidebarSiniflar" data-bs-toggle="collapse" role="button" aria-expanded="{{ in_array($currentRoute, $coursesRoutes) ? 'true' : 'false' }}" aria-controls="sidebarEgitimler">
                        <i class="ri-book-fill"></i> <span data-key="t-dashboards">Sınıf Listeleri</span>
                    </a>
                    <div class="collapse menu-dropdown {{ in_array($currentRoute, $coursesRoutes) ? 'show' : '' }}" id="sidebarSiniflar">
                        <ul class="nav nav-sm flex-column">

                            <li class="nav-item">
                                <a href="{{ route('class.all-list') }}" class="nav-link {{ $currentRoute == 'class.list' ? 'active' : '' }}">
                                    <span data-key="t-analytics">Tüm Öğrenciler </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('class.list') }}" class="nav-link {{ $currentRoute == 'class.list' ? 'active' : '' }}">
                                    <span data-key="t-analytics">Mevcut Sınıflara Ait Öğrenciler </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('class.old-list') }}" class="nav-link {{ $currentRoute == 'class.old-list' ? 'active' : '' }}">
                                    <span data-key="t-analytics">Geçmiş Dönem Sınıflara Ait Öğrenciler </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->


                <li class="nav-item">
                    @php
                        $coursesRoutes = ['class.create', 'class.index'];
                    @endphp
                    <a class="nav-link menu-link {{ in_array($currentRoute, $coursesRoutes) ? 'active' : '' }}" href="#sidebarSiniflarDuzenle" data-bs-toggle="collapse" role="button" aria-expanded="{{ in_array($currentRoute, $coursesRoutes) ? 'true' : 'false' }}" aria-controls="sidebarEgitimler">
                        <i class="ri-book-fill"></i> <span data-key="t-dashboards">Sınıflar Düzenle</span>
                    </a>
                    <div class="collapse menu-dropdown {{ in_array($currentRoute, $coursesRoutes) ? 'show' : '' }}" id="sidebarSiniflarDuzenle">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('class.create') }}" class="nav-link {{ $currentRoute == 'class.create' ? 'active' : '' }}">
                                    <span data-key="t-job">Yeni Sınıf Ekle</span> <span class="badge badge-pill bg-success" data-key="t-new">+</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('class.index') }}" class="nav-link {{ $currentRoute == 'class.index' ? 'active' : '' }}">
                                    <span data-key="t-analytics"> Sınıfları Listele </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->


                <li class="nav-item">
                    <a class="nav-link menu-link {{ $currentRoute == 'on-kayit-basvurulari.index' ? 'active' : '' }}" href="{{ route('on-kayit-basvurulari.index') }}">
                        <i class="ri-inbox-archive-line"></i> <span data-key="t-dashboards">Ön Kayit Başvuruları</span>
                    </a>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link {{ $currentRoute == 'kesin-kayit-basvurulari.index' ? 'active' : '' }}" href="{{ route('kesin-kayit-basvurulari.index') }}">
                        <i class="ri-inbox-archive-line"></i> <span data-key="t-dashboards">Kesin Kayit Başvuruları</span>
                    </a>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    @php
                        $aboutRoutes = ['yonetim.index', 'yonetimkurulu.index', 'egitmenler.index','formlar.index','banka-is.index'];
                    @endphp
                    <a class="nav-link menu-link {{ in_array($currentRoute, $aboutRoutes) ? 'active' : '' }}" href="#sidebarAbout" data-bs-toggle="collapse" role="button" aria-expanded="{{ in_array($currentRoute, $aboutRoutes) ? 'true' : 'false' }}" aria-controls="sidebarAbout">
                        <i class="ri-chat-poll-line"></i> <span data-key="t-dashboards">Hakkımızda</span>
                    </a>
                    <div class="collapse menu-dropdown {{ in_array($currentRoute, $aboutRoutes) ? 'show' : '' }}" id="sidebarAbout">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('yonetimkurulu.index') }}" class="nav-link {{ $currentRoute == 'yonetimkurulu.index' ? 'active' : '' }}">
                                    <span data-key="t-job">Yönetim Kurulu</span> <span class="badge badge-pill bg-success" data-key="t-new">+</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('yonetim.index') }}" class="nav-link {{ $currentRoute == 'yonetim.index' ? 'active' : '' }}">
                                    <span data-key="t-job">Yönetim</span> <span class="badge badge-pill bg-success" data-key="t-new">+</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('egitmenler.index') }}" class="nav-link {{ $currentRoute == 'egitmenler.index' ? 'active' : '' }}">
                                    <span data-key="t-job">Eğitmenlerimiz</span> <span class="badge badge-pill bg-success" data-key="t-new">+</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('formlar.index') }}" class="nav-link {{ $currentRoute == 'formlar.index' ? 'active' : '' }}">
                                    <span data-key="t-job">Formlar</span> <span class="badge badge-pill bg-success" data-key="t-new">+</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('banka-is.index') }}" class="nav-link {{ $currentRoute == 'banka-is.index' ? 'active' : '' }}">
                                    <span data-key="t-job">Banka ve İşbirlikleri</span> <span class="badge badge-pill bg-success" data-key="t-new">+</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('education-request.index') }}" class="nav-link {{ $currentRoute == 'education-request.index' ? 'active' : '' }}">
                                    <span data-key="t-job">Eğitim Talebi</span> <span class="badge badge-pill bg-success" data-key="t-new">+</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('organization-chart.index') }}" class="nav-link {{ $currentRoute == 'organization-chart.index' ? 'active' : '' }}">
                                    <span data-key="t-job">Organizasyon Şeması</span> <span class="badge badge-pill bg-success" data-key="t-new">+</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ $currentRoute == 'settings.index' ? 'active' : '' }}" href="{{ route('settings.index') }}">
                        <i class="ri-settings-2-fill"></i> <span data-key="t-dashboards">Ayarlar</span>
                    </a>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    @php
                        $sliderRoutes = ['slider.create', 'slider.index'];
                    @endphp
                    <a class="nav-link menu-link {{ in_array($currentRoute, $sliderRoutes) ? 'active' : '' }}" href="#sidebarSlider" data-bs-toggle="collapse" role="button" aria-expanded="{{ in_array($currentRoute, $sliderRoutes) ? 'true' : 'false' }}" aria-controls="sidebarSlider">
                        <i class="ri-image-2-line"></i> <span data-key="t-dashboards">Slider</span>
                    </a>
                    <div class="collapse menu-dropdown {{ in_array($currentRoute, $sliderRoutes) ? 'show' : '' }}" id="sidebarSlider">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('slider.create') }}" class="nav-link {{ $currentRoute == 'slider.create' ? 'active' : '' }}">
                                    <span data-key="t-job">Yeni Slider</span> <span class="badge badge-pill bg-success" data-key="t-new">+</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('slider.index') }}" class="nav-link {{ $currentRoute == 'slider.index' ? 'active' : '' }}">
                                    <span data-key="t-analytics"> Slider Listele </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link {{ $currentRoute == 'categories.index' ? 'active' : '' }}" href="{{ route('categories.index') }}">
                        <i class="ri-medal-2-fill"></i> <span data-key="t-dashboards">Kategoriler</span>
                    </a>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link {{ $currentRoute == 'gallery.index' ? 'active' : '' }}" href="{{ route('gallery.index') }}">
                        <i class="ri-medal-2-fill"></i> <span data-key="t-dashboards">Galeri</span>
                    </a>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    @php
                        $coursesRoutes = ['courses.create', 'courses.index'];
                    @endphp
                    <a class="nav-link menu-link {{ in_array($currentRoute, $coursesRoutes) ? 'active' : '' }}" href="#sidebarEgitimler" data-bs-toggle="collapse" role="button" aria-expanded="{{ in_array($currentRoute, $coursesRoutes) ? 'true' : 'false' }}" aria-controls="sidebarEgitimler">
                        <i class="ri-book-fill"></i> <span data-key="t-dashboards">Eğitimler</span>
                    </a>
                    <div class="collapse menu-dropdown {{ in_array($currentRoute, $coursesRoutes) ? 'show' : '' }}" id="sidebarEgitimler">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('courses.create') }}" class="nav-link {{ $currentRoute == 'courses.create' ? 'active' : '' }}">
                                    <span data-key="t-job">Yeni Eğitim</span> <span class="badge badge-pill bg-success" data-key="t-new">+</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('courses.index') }}" class="nav-link {{ $currentRoute == 'courses.index' ? 'active' : '' }}">
                                    <span data-key="t-analytics"> Eğitimleri Listele </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    @php
                        $usersRoutes = ['users.create', 'users.index'];
                    @endphp
                    <a class="nav-link menu-link {{ in_array($currentRoute, $usersRoutes) ? 'active' : '' }}" href="#sidebarUsers" data-bs-toggle="collapse" role="button" aria-expanded="{{ in_array($currentRoute, $usersRoutes) ? 'true' : 'false' }}" aria-controls="sidebarUsers">
                        <i class="ri-shield-user-line"></i> <span data-key="t-dashboards">Kullanıcılar</span>
                    </a>
                    <div class="collapse menu-dropdown {{ in_array($currentRoute, $usersRoutes) ? 'show' : '' }}" id="sidebarUsers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('users.create') }}" class="nav-link {{ $currentRoute == 'users.create' ? 'active' : '' }}">
                                    <span data-key="t-job">Yeni Kullanıcı</span> <span class="badge badge-pill bg-success" data-key="t-new">+</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link {{ $currentRoute == 'users.index' ? 'active' : '' }}">
                                    <span data-key="t-analytics"> Kullanıcıları Listele </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->






            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
