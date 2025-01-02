<footer id="react-footer" class="react-footer home-main">
    {{-- Cookie Consent Banner --}}
    <div id="cookie-consent-banner" class="cookie-banner" style="display: none;">
        <div class="cookie-content">
            <p>Bu web sitesi deneyiminizi geliştirmek için çerezleri kullanmaktadır.</p>
            <div class="cookie-buttons">
                <button onclick="acceptAllCookies()" class="accept-button">Tümünü Kabul Et</button>
                <button onclick="showCookieSettings()" class="settings-button">Çerezleri Yönet</button>
                <button onclick="rejectCookies()" class="reject-button">Reddet</button>
            </div>
        </div>
    </div>

    {{-- Cookie Settings Modal --}}
    <div id="cookie-settings-modal" class="cookie-modal" style="display: none;">
        <div class="modal-content">
            <h3>Çerez Ayarları</h3>
            <div class="cookie-group">
                <div class="cookie-group-header">
                    <label>
                        <input type="checkbox" checked disabled>
                        Gerekli Çerezler
                    </label>
                    <p>Bu çerezler web sitesinin çalışması için gereklidir ve devre dışı bırakılamaz.</p>
                </div>
            </div>
            <div class="cookie-group">
                <div class="cookie-group-header">
                    <label>
                        <input type="checkbox" id="optional-cookies" checked>
                        Hedefleme ve Reklam Çerezleri
                    </label>
                    <p>Bu çerezler, size özelleştirilmiş içerik ve reklamlar sunmamıza yardımcı olur.</p>
                </div>
            </div>
            <div class="modal-buttons">
                <button onclick="saveCookieSettings()" class="save-button">Ayarları Kaydet</button>
            </div>
        </div>
    </div>

    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 md-mb-30">
                    <div class="footer-widget footer-widget-1">
                        <div class="footer-logo white">
                            <a href="{{route('home.index')}}" class="logo-text"> <img src="{{asset('backend/my-image/sem-beyaz.svg.svg')}}" width="250px" alt="logo"></a>
                        </div>
                        <h5 class="footer-subtitle">Tahılpazarı Mah. Adnan Menderes Bulvarı No:84 Muratpaşa / ANTALYA</h5>
                        <ul class="footer-address">
                            <li><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg><a href="tel:+(90)2422450242"> +90 242 245 0 245 </a></li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg><a href="mailto:sem@antalya.edu.tr"> sem@antalya.edu.tr </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 md-mb-30">
                    <div class="footer-widget footer-widget-2">
                        <h3 class="footer-title">Hakkımızda</h3>
                        <div class="footer-menu">
                            <ul>
                                <li><a href="{{route('hakkimizda_yonetim.index')}}">Yönetim</a></li>
                                <li><a href="{{route('hakkimizda_yonetim_kurulu.index')}}">Yönetim Kurulu</a></li>
                                <li><a href="{{route('hakkimizda_egitmenler.index')}}">Eğitmenler</a></li>
                                <li><a href="{{route('hakkimizda_formlar.index')}}">Formlar</a></li>
                                <li><a href="{{route('hakkimizda_banka_hesap.index')}}">Banka Hesap Bilgileri</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 md-mb-30">
                    <div class="footer-widget footer-widget-3">
                        <h3 class="footer-title">Hızlı Erişim</h3>
                        <div class="footer-menu">
                            <ul>
                                <li><a href="{{route('home.index')}}">Anasayfa</a></li>
                                <li><a href="{{route('hakkimizda_egitmenler.index')}}">Egitimler</a></li>
                                <li><a href="#">Galeri</a></li>
                                <li><a href="{{route('hakkimizda_iletisim.index')}}">İletişim</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="footer-widget footer-widget-4">
                        <div class="footer-logo white">
                            <a href="{{route('home.index')}}" class="logo-text"> <img src="{{asset('backend/my-image/abu-beyaz.svg')}}" alt="logo"></a>
                        </div>
                        <div class="footer3__form">
                            <p>Çıplaklı Mah. Akdeniz Bulvarı No:290 A Döşemealtı/Antalya</p>
                            <ul class="footer-address">

                            <li><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg><a href="tel:+(90)2422450000"> +90 242 245 00 00 </a></li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg><a href="mailto: info@antalya.edu.tr"> info@antalya.edu.tr </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="copyright">
        <div class="container">
            <div class="react-copy-left">© 2024 <a href="https://antalya.edu.tr">Antalya Bilim Üniversitesi -</a> Sürekli Eğitim, Araştırma ve Uygulama Merkezi | Tüm hakları saklıdır.</div>
            <div class="react-copy-right">
                <ul class="social-links">
                    <li class="follow">Bizi Takip Et</li>
                    <li><a href="https://www.facebook.com/AntalyaSEM"><span aria-hidden="true" class="social_facebook"></span></a></li>
                    <li><a href="https://www.instagram.com/antalyasem/"><span aria-hidden="true" class="social_instagram"></span></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<style>
.cookie-banner {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.9);
    color: white;
    padding: 1rem;
    z-index: 9999;
}

.cookie-content {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.cookie-buttons {
    display: flex;
    gap: 1rem;
}

.accept-button {
    background: #f1d600;
    color: black;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    cursor: pointer;
}

.reject-button {
    background: #666;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    cursor: pointer;
}

.cookie-modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10000;
}

.modal-content {
    background: white;
    padding: 2rem;
    border-radius: 8px;
    max-width: 600px;
    width: 90%;
    color: #333;
}

.cookie-group {
    margin: 1rem 0;
    padding: 1rem;
    border: 1px solid #eee;
    border-radius: 4px;
}

.cookie-group-header label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: bold;
}

.cookie-group p {
    margin: 0.5rem 0;
    font-size: 0.9rem;
    color: #666;
}

.modal-buttons {
    margin-top: 1rem;
    text-align: right;
}

.settings-button {
    background: #fff;
    color: #000;
    border: 1px solid #000;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    cursor: pointer;
}

.save-button {
    background: #f1d600;
    color: black;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    cursor: pointer;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (!getCookie('cookieConsent')) {
        document.getElementById('cookie-consent-banner').style.display = 'block';
    }
});

// Cookie işlemleri için yardımcı fonksiyonlar
function setCookie(name, value, days) {
    const date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    const expires = "; expires=" + date.toUTCString();
    document.cookie = name + "=" + value + expires + "; path=/";
}

function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function acceptAllCookies() {
    setCookie('cookieConsent', 'accepted', 365);
    setCookie('optionalCookies', 'true', 365);
    document.getElementById('cookie-consent-banner').style.display = 'none';
}

function rejectCookies() {
    setCookie('cookieConsent', 'rejected', 365);
    setCookie('optionalCookies', 'false', 365);
    document.getElementById('cookie-consent-banner').style.display = 'none';
}

function showCookieSettings() {
    document.getElementById('cookie-settings-modal').style.display = 'flex';

    // Mevcut cookie ayarlarını yükle
    const optional = getCookie('optionalCookies') !== 'false';
    document.getElementById('optional-cookies').checked = optional;
}

function saveCookieSettings() {
    const optional = document.getElementById('optional-cookies').checked;

    setCookie('cookieConsent', 'custom', 365);
    setCookie('optionalCookies', optional, 365);

    document.getElementById('cookie-settings-modal').style.display = 'none';
    document.getElementById('cookie-consent-banner').style.display = 'none';
}

// Modal dışına tıklandığında kapatma
document.getElementById('cookie-settings-modal').addEventListener('click', function(e) {
    if (e.target === this) {
        this.style.display = 'none';
    }
});
</script>
