@extends('frontend.components.master')

@section('addcss')
    <style>
        .tab-content {
            padding: 1.5rem;
        }
        .tab-button {
            @apply px-4 py-2 border-b-2 font-semibold cursor-pointer;
        }
        .tab-button-active {
            @apply border-blue-500 text-blue-500;
        }
        .tab-button-inactive {
            @apply border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-5">
        <!-- Sekme Başlıkları -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab" aria-controls="tab1" aria-selected="true">KVKK</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab" aria-controls="tab2" aria-selected="false">Mesafeli Satış Sözleşmesi</button>
            </li>
        </ul>

        <!-- Sekme İçerikleri -->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                <pre>
                    ÇEREZ VE KVK POLİTİKASI, GİZLİLİK BİLDİRİMİ VE KİŞİSEL VERİLER HAKKINDA AYDINLATMA

                    Antalya Bilim  Üniversitesi Sürekli Eğitim Uygulama ve Araştırma Merkezi (“ABÜSEM”) olarak ABÜSEM web sitesini ziyaret edenlerin, ABÜSEM
                    aday işlemleri panelini kullanan kişilerin ve bizimle elektronik olarak iletişim kuran herkesin kişisel verilerine saygı gösteriyoruz.
                    ABÜSEM olarak eğitim ve hizmetlerimizden faydalanan kişiler dahil, SEM ile ilişkili tüm gerçek kişilere ait
                    her türlü kişisel verilerin 6698 sayılı Kişisel Verilerin Korunması Kanunu (“KVK Kanunu”)’na uygun olarak işlenmesini ve muhafazasını
                    sağlamak için gerekli tedbirleri alıyoruz. İşbu gizlilik bildirimi (“Gizlilik Bildirimi”), web sitemizi kullanırken kullanıcılara
                    ilişkin ne tür bilgilerin ABÜSEM tarafından alındığını, bunların nasıl kullanıldığını ve korunduğunu açıklamaktadır.
                    Bu sorumluluğumuzun farkında olarak, KVK Kanunu’nda tanımlı şekli ile “Veri Sorumlusu” sıfatıyla, kişisel verilerinizi aşağıda açıklandığı
                    şekliyle ve mevzuat tarafından belirlenen sınırlar çerçevesinde işlemekteyiz.


                    1. İşlenen Kişisel Verilerin Türleri

                    Bu Gizlilik Bildiriminde, “kişisel verileriniz” kimliğinizi veya üçüncü bir kişinin kimliğini belirten ya da belirlenebilir kılan her
                    türlü veriyi ifade eder.

                    Bunlar sınırlı olmamak kaydıyla işin doğası gereği adınızı, kimlik bilgilerinizi, adresinizi, telefon numaranızı, IP adresinizi,
                    e-posta adresinizi ve ABÜSEM’de başvurduğunuz önceki eğitim ve sınav bilgilerini içerir. E-posta adresi ve telefon numarası sizi
                    bilgilendirmek için toplanmaktadır. Bilgilerinizi eksik/hatalı yazarak başvuru yaparsanız size bilgilendirme yapılamamasından
                    dolayı sorumluluk kabul edilmez. ABÜSEMWEB “Duyuru Bildirimi” için "OneSignal" kullanılmakta olup kişisel veri toplamamaktadır.


                    2. Kişisel Verilerin Toplanması, İşlenmesi ve İşleme Amaçları

                    Kişisel verileriniz, ABÜSEM tarafından sağlanan hizmet ve ticari faaliyetlere bağlı olarak değişkenlik gösterebilmekle birlikte;
                    otomatik ya da otomatik olmayan yöntemlerle, üniversitemiz
                    birimleri ve ofisler, internet sitesi, sosyal medya, mobil uygulamalar ve benzeri vasıtalarla sözlü, yazılı ya da elektronik
                    olarak toplanabilecektir. ABÜSEM’in sunduğu hizmetlerden yararlandığınız sürece kişisel verileriniz işlenebilecektir.

                    Ayrıca, ABÜSEM’in hizmetlerini kullanmak amacıyla çağrı merkezlerimizi veya internet sayfamızı kullandığınızda, ABÜSEM binasını
                    veya internet sitemizi ziyaret ettiğinizde, ABÜSEM tarafından düzenlenen eğitim, seminer veya organizasyonlara katıldığınızda kişisel
                    verileriniz işlenebilecektir. Bunun yanında tarafınıza sunulan hizmetin tamamlanabilmesi için ABÜSEM olarak kimlik bilgileri vb. zorunlu
                    bilgileri sizin adınıza ilgili kuruluştan almaktayız.

                    SEM tarafından sunulan eğitim ve hizmetlerden sizleri faydalandırmak için gerekli çalışmaların iş birimlerimiz tarafından yapılması,
                    ABÜSEM tarafından sunulan eğitim ve hizmetlerin sizlerin beğeni, kullanım alışkanlıkları ve ihtiyaçlarına göre özelleştirilerek sizlere
                    önerilmesi, ABÜSEM ile iş ilişkisi içerisinde olan 3.şahısların hukuki ve ticari güvenliğinin temini amaçlarıyla bilgi toplanmaktadır.

                    3. İşlenen Kişisel Verilerin Kimlere ve Hangi Amaçla Aktarılabileceği

                    Kişisel verileriniz adli ya da idari mercilerce öngörülmesi hali dışında bu Gizlilik Bildirimi’nde belirtilenler haricinde üçüncü
                    kişilerle paylaşılmayacaktır.

                    Kişisel verilerinizi,

                    – Hukuk eğitimlerinin gerçekleştirilebilmesi için Adalet Bakanlığıyla,
                    – Sağlık eğitimlerinin gerçekleştirilebilmesi için Sağlık Bakanlığıyla,
                    – Personel Belgelendirme hizmetleri için MYK ve/veya TÜRKAK ile,
                    – ABÜSEM için destek hizmetleri sağlayan, sitelerimizi barındıran veya işleten; verileri analiz eden hizmet sağlayıcıları (Google),
                          eğitimlerin sizlere ulaştırılmasına yardımcı
                    olan hizmet sağlayıcıları, müşteri hizmetleri sunan, ödemeleri yöneten hizmet sağlayıcıları vb.- üçüncü kişiler ile,

                    – Kanunen yetkili kamu kurumları ile KVK Kanunu’nun 8. ve 9. maddelerinde belirtilen kişisel veri işleme şartları ve amaçları
                    çerçevesinde paylaşabiliriz.

                    İlgili üçüncü kişiler, söz konusu hizmeti yerine getirebilmek için gerekli olan ilgili kişisel veriye erişim sağlamaktadır. Bu durumda,
                    söz konusu üçüncü kişiler, bilgileriniziyalnızca ABÜSEM adına hizmet vermek için kullanacak, sözleşmesel yükümlülükleri çerçevesinde bu
                    bilgileri gizli tutmak ve başka hiçbir amaçla kullanmama yükümlülüğü altında olacaklardır.

                    4. Kişisel Veri Toplamanın Yöntemi ve Hukuki Sebebi

                    Kişisel verileriniz, her türlü sözlü, yazılı ya da elektronik ortamda, otomatik veya otomatik olmayan yollar ile yukarıda yer verilen
                    gerekçeler doğrultusunda SEM tarafından düzenlenen eğitim, seminer, organizasyonlar veya hizmetlerin belirlenen yasal çerçevede sunulabilmesi
                    ve bu kapsamda ABÜSEM’in sözleşme ve yasadan doğan yükümlülüklerini eksiksiz ve doğru bir şekilde ifa edilebilmesi için elde ile edilir.

                    Bu hukuki sebeple toplanan kişisel verileriniz KVK Kanunu’nun 5. ve 6. maddelerinde belirtilen kişisel veri işleme şartları ve amaçları
                    kapsamında bu metnin (2) ve (3) numaralı maddelerinde belirtilen gerekçelerle de işlenebilmekte ve aktarılabilmektedir.

                    5. Kişisel Veri Sahibinin KVK Kanunu’nun 11. maddesinde Sayılan Hakları

                    Kişisel veri sahipleri olarak, haklarınıza ilişkin taleplerinizi, işbu Gizlilik Bildirimi’nde aşağıda düzenlenen yöntemlerle ABÜSEM’e
                    iletmeniz durumunda ABÜSEM talebin niteliğine göre talebinizi mümkün olan en kısa sürede ve en geç otuz gün içinde sonuçlandıracaktır.

                    Başkalarının gizliliğini tehlikeye atan veya başka şekilde aşırı derecede zor olan istekleri reddetme hakkımız ve işlemin ayrıca
                    bir maliyeti gerektirmesi hâlinde,
                    Kişisel Verileri Koruma Kurulu tarafından belirlenen ücret tarifesi üzerinden ücret talep etme hakkımız saklıdır.

                    Bu kapsamda kişisel veri sahiplerinin;

                    - Kişisel veri işlenip işlenmediğini öğrenme,

                    - Kişisel verileri işlenmişse buna ilişkin bilgi talep etme,

                    - Kişisel verilerin işlenme amacını ve bunların amacına uygun kullanılıp kullanılmadığını öğrenme,

                    - Yurt içinde veya yurt dışında kişisel verilerin aktarıldığı üçüncü kişileri bilme,

                    - Kişisel verilerin eksik veya yanlış işlenmiş olması hâlinde bunların düzeltilmesini isteme ve bu kapsamda yapılan işlemin kişisel
                    verilerin aktarıldığı üçüncü kişilere bildirilmesini isteme,

                    - KVK Kanunu’nun ve ilgili diğer kanun hükümlerine uygun olarak işlenmiş olmasına rağmen, işlenmesini gerektiren sebeplerin ortadan
                    kalkması hâlinde kişisel verilerin silinmesini veya yok edilmesini isteme ve bu kapsamda yapılan işlemin kişisel verilerin aktarıldığı
                    üçüncü kişilere bildirilmesini isteme,

                    - İşlenen verilerin münhasıran otomatik sistemler vasıtasıyla analiz edilmesi suretiyle kişinin kendisi aleyhine bir sonucun ortaya
                    çıkmasına itiraz etme,

                    - Kişisel verilerin kanuna aykırı olarak işlenmesi sebebiyle zarara uğraması hâlinde zararın giderilmesini talep etme haklarına sahiptir.

                    Ek olarak, kişisel verilerinizi ABÜSEMAİP sistemine giriş yaparak kendiniz güncelleyebilirsiniz.

                    6. Kişisel Veri Sahibinin Başvuru Hakkı

                    KVK Kanunu’nun 13. maddesinin 1. fıkrası gereğince, yukarıda belirtilen haklarınızı kullanmak için kimliğinizi tespit edici gerekli
                    bilgiler (3. kişiler adına yapılan başvurular için özel vekaletnameleri) ile KVK Kanunu’nun 11. maddesinde belirtilen haklardan kullanmayı
                    talep ettiğiniz hakkınıza yönelik açıklamalarınızı içeren talebinizi sem@antalya.edu.tr e-posta adresinden veya aşağıdaki adresten bizzat
                    elden veya noter vasıtasıyla tebligat yoluyla iletebilirsiniz. Başvuru Formu için tıklayınız.

                    Antalya Bilim Üniversitesi Sürekli Eğitim Uygulama ve Araştırma Merkezi (ABÜSEM)

                    Adres: Tahılpazarı Mah. Adnan Menderes Blv. No.84 MarkAntalya AVM üzeri 7. Kat Muratpaşa/Antalya

                    ABÜSEM olarak, 6698 sayılı Kişisel Verilerin Korunması Kanunu’nda herhangi bir değişiklik yayınlanması halinde işbu Bilgilendirme
                    Metnini güncelleyeceğimizi taahhüt ederiz. ABÜSEM, Bilgilendirme Metni hükümlerini dilediği zaman sitede yayınlamak veya kullanıcılara
                    elektronik posta göndermek suretiyle değiştirebilir. Bilgilendirme Metni hükümleri değiştiği takdirde, yayınlandığı tarihte yürürlük kazanır.

                    7. Güvenlik

                    ABÜSEM, size ait bilgileri güvenli biçimde saklamakta ve gerekli tüm önlemleri almaktadır. ABÜSEM'in, gerekli hizmeti size ulaştırmak
                    için bilgilerinize erişimi olan sözleşme ortakları, sözleşme yükümlülükleri çerçevesinde bu bilgileri gizli tutmak ve başka hiçbir
                    amaçla kullanmamakla yükümlüdür. Bu metnin (2) ve (3) numaralı maddelerinde belirtilen nedenlerle kişisel bilgilerinizin bir kısmı
                    veya tamamı ilgili kamu kurum veya kuruluşlar ile paylaşılması gerekecektir. Bu durumlarda da bilgileriniz gizli addedilecektir.


                    8. Çerez Politikası

                    Çerez, bir web sitesi sunucusu tarafından bilgisayarınıza veya mobil cihazınıza kaydedilen basit bir metin dosyasıdır. Sadece
                    bu sunucu ilgili çerezin içeriğine erişebilir veya bu bilgileri okuyabilir. Her çerez, web tarayıcınıza özeldir. Bir benzersiz
                    tanımlayıcı, site adı ve bazı numaralar gibi anonim bilgiler içerir. Web sitesinin bazı öğeleri, örneğin tercihlerinizi
                    hatırlamasını sağlar. Çerezler, ziyaret ettiğiniz web sitesi (bunlar "birinci taraf çerezler" olarak bilinir)
                    veya görüntülediğiniz sayfada içerik sunan diğer web siteleri ("üçüncü taraf çerezler") tarafından belirlenebilir.

                    a.       Birinci Taraf Çerezler

                    ABÜSEMAİP sistemine giriş yapabilmeniz, oturumunuzu ve gezinme adımlarınızı yönetmek için kullanılan çerezlerdir. Kesinlikle gereklidir.
                    ABÜSEMWEB, oturum çerezi ve kullanıcının çerez etiketini kapatıp-kapatmadığı bilgisini içeren çerez kullanmaktadır. Kapatıldıktan sonra
                    çerez etiketinin bir hafta boyunca tekrar görüntülenmemesini sağlar.


                    b.      Üçüncü Taraf Çerezler

                    Google analitikleri: Bu tür çerezler tüm istatistiksel verilerin toplanmasını bu şekilde sitenin sunumunun ve kullanımının geliştirilmesini
                    sağlar. Google, bu istatistiklere toplumsal istatistikler ve ilgilere ilişkin veriler eklemek suretiyle, kullanıcıları daha iyi anlamamızı
                    sağlar. ABÜSEMAİP ve ABÜSEMWEB, Google Analitik çerezleri kullanmaktadır. Söz konusu çerezler ile toplanan veriler, ABD’de bulunan Google
                    sunucularına aktarılmakta ve söz konusu veriler Google’ın veri koruma ilkeleri ile uyumlu olarak muhafaza edilmektedir. Bu verilerin
                    toplanmasını istemiyorsanız bu linki ziyaret ediniz: https://tools.google.com/dlpage/gaoptout
                    OneSignal: ABÜSEMWEB tarafından yeni duyuru eklendiğinde bildirim göndermek amacıyla kullanılmakta olup onayınız olmadan size
                    bildirim gönderilmemektedir.
                    Üçüncü taraf çerezleri kabul etmez veya engellerseniz bildirim alamazsınız.

                    Tarayıcınızın ayarlarını değiştirerek çerezlere ilişkin tercihlerinizi kişiselleştirme imkanına sahipsiniz.
                </pre>
            </div>
            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                <pre>
                    1. TARAFLAR
                    İşbu Sözleşme aşağıdaki taraflar arasında aşağıda belirtilen hüküm ve şartlar çerçevesinde imzalanmıştır.
                    A."ALICI" ; basvuru.antalya.edu.tr adresinden alışveriş yapan kişi (sözleşmede bundan sonra "ALICI" olarak anılacaktır)

                    B."SATICI" ; (sözleşmede bundan sonra "SATICI" olarak anılacaktır)
                    Ünvanı  : ANTALYA BİLİM ÜNİVERSİTESİ
                    Adres   : MARKANTALYA YERLEŞKESİ/ANTALYA
                    E-Posta : sem@antalya.edu.tr
                    Telefon : 0242 245 02 45
                    Faks    : 0 242 245 01 00

                    İş bu sözleşmeyi kabul etmekle ALICI, sözleşme konusu siparişi onayladığı takdirde sipariş konusu bedeli ve varsa kargo ücreti, vergi
                    gibi belirtilen ek ücretleri ödeme yükümlülüğü altına gireceğini ve bu konuda bilgilendirildiğini peşinen kabul eder.

                    2. KONU

                    İşbu sözleşmenin konusu, ALICI'nın SATICI'ya ait basvuru.sakarya.edu.tr internet sitesinden elektronik ortamda siparişini yaptığı
                    aşağıda nitelikleri ve satış fiyatı belirtilen ürünün satışı ve teslimi ile ilgili olarak 4077 sayılı Tüketicilerin Korunması
                    Hakkındaki Kanun ve Mesafeli Sözleşmeleri Uygulama Esas ve Usulleri Hakkında Yönetmelik hükümleri gereğince tarafların hak ve
                    yükümlülüklerinin saptanmasıdır. İlan edilen fiyatlar güncelleme yapılana ve değiştirilene kadar geçerlidir.

                    3. SÖZLEŞME KONUSU ÜRÜN/ÜRÜNLER BİLGİLERİ

                    3.1. Eğitimlerin süresi, eğitim şekli, eğitim yeri ve vergiler dahil satış bedeli web sayfasında belirtildiği gibidir.
                    3.2. Ödeme Şekli : basvuru.antalya.edu.tr üzerinden eğitim kredi kartıyla ya da eft/havale yöntemi ile satın alınabilir.
                    3.3. Teslimat Şekli ve Adresi : Eğitimler online tabanlı olduğu için gerekli olan bilgiler üye olurken belirtilen cep telefonu
                    numarasına gönderilecektir.

                    İADE PROSEDÜRÜ:

                    A) KREDİ KARTINA İADE PROSEDÜRÜ
                    ALICI'nın cayma hakkını kullandığı durumlarda ya da Hakem heyeti kararları ile Tüketiciye bedel iadesine karar verilen durumlarda,
                    SATICI müşteriye geri ödemesinihttps://abüsem.antalya.edu.tr/2/6436/egitim-ucret-iadesi-proseduru adresinde belirtilen prosedür ile
                    yapmaktadır. ALICI prosedürü uyguladıktan sonra ücret iadesiyapılacaktır. ALICI, bu prosedürü okuduğunu ve kabul ettiğini taahhüd eder.

                    B) HAVALE/EFT ÖDEME SEÇENEKLERİNDE İADE PROSÜDÜRÜ
                    Havale/EFT ödeme seçeneklerinde iade Tüketiciden banka hesap bilgileri istenerek, Tüketicinin belirttiği hesaba (hesabın fatura
                    adresindeki kişinin adına veya kullanıcıüyenin adına olması şarttır) Havale veya EFT şeklinde yapılacaktır.

                    4. FATURA BİLGİLERİ

                    Web sayfamızda, sipariş esnasında belirtmiş olduğunuz kişisel bilgiler kullanılacaktır ya da kurumsal fatura oluşturmak istiyorsanız
                    iletişim kısmından bize ulaşmanız gerekmektedir.

                    5. GENEL HÜKÜMLER

                    5.1- ALICI, basvuru.antalya.edu.tr internet sitesinde sözleşme konusu ürünün temel nitelikleri, satış fiyatı ve ödeme şekli ile teslimata
                    ilişkin ön bilgileri okuyup bilgisahibi olduğunu ve elektronik ortamda gerekli teyidi verdiğini beyan eder.
                    5.2- Sözleşme konusu ürün, yasal 30 günlük süreyi aşmamak koşulu ile her bir ürün için ALICI'nın yerleşim yerinin uzaklığına bağlı olarak
                    internet sitesinde ön bilgileriçinde açıklanan süre içinde ALICI veya gösterdiği adresteki kişi/kuruluşa teslim edilir.
                    5.3- Sözleşme konusu ürün, ALICI'dan başka bir kişi/kuruluşa teslim edilecek ise, teslim edilecek kişi/kuruluşun teslimatı kabul
                    etmemesinden SATICI sorumlu tutulamaz.
                    5.4- SATICI, sözleşme konusu ürünün sağlam, eksiksiz, siparişte belirtilen niteliklere uygun ve varsa garanti belgeleri ve kullanım
                    kılavuzları ile teslim edilmesinden sorumludur.
                    5.5- Sözleşme konusu ürünün teslimatı için işbu sözleşmenin imzalı nüshasının SATICI'ya ulaştırılmış olması ve bedelinin ALICI'nın
                    tercih ettiği ödeme şekli ile ödenmiş olması şarttır. Herhangi bir nedenle ürün bedeli ödenmez veya banka kayıtlarında iptal edilir ise,
                    SATICI ürünün teslimi yükümlülüğünden kurtulmuş kabul edilir.
                    5.6- Ürünün tesliminden sonra ALICI'ya ait kredi kartının ALICI'nın kusurundan kaynaklanmayan bir şekilde yetkisiz kişilerce haksız veya
                    hukuka aykırı olarak kullanılması nedeni ile ilgili banka veya finans kuruluşun ürün bedelini SATICI'ya ödememesi halinde, ALICI'nın
                    kendisine teslim edilmiş olması kaydıyla eğitim giriş kayıt bilgilerini 3 gün içinde SATICI'ya bildirmesi zorunludur.

                    6. CAYMA HAKKI

                    ALICI, sözleşme konusu olan eğitime giriş yaptıktan sonra(*) içeriklerin kopyalanması durumundan dolayı cayma hakkı yoktur. Eğitime giriş
                    yapmadan ondört (14) gün içinde cayma hakkı vardır.

                    * Tüketici Kanunu ve Mesafeli Satış Sözleşmeleri Yönetmeliği'nde belirtilen cayma hakkının istisnaları MADDE 15 'in "ğ" bendine göre
                    Elektronik ortamda anında ifaedilen hizmetler veya tüketiciye anında teslim edilen gayrimaddi mallara ilişkin sözleşmeler gereğince kişi
                    cayma hakkını kullanamaz.

                    7. TEMERRÜT HALİ VE HUKUKİ SONUÇLARI

                    ALICI, ödeme işlemlerini kredi kartı ile yaptığı durumda temerrüde düştüğü takdirde, kart sahibi banka ile arasındaki kredi kartı
                    sözleşmesi çerçevesinde faiz ödeyeceğini vebankaya karşı sorumlu olacağını kabul, beyan ve taahhüt eder. Bu durumda ilgili banka hukuki
                    yollara başvurabilir; doğacak masrafları ve vekâlet ücretini ALICI’dan talepedebilir ve her koşulda ALICI’nın borcundan dolayı temerrüde
                    düşmesi halinde, ALICI, borcun gecikmeli ifasından dolayı SATICI’nın uğradığı zarar ve ziyanını ödeyeceğini kabul,beyan ve taahhüt eder

                    8. YETKİLİ MAHKEME

                    İşbu sözleşmeden doğan uyuşmazlıklarda şikayet ve itirazlar, tüketicinin yerleşim yerinin bulunduğu veya tüketici işleminin yapıldığı
                    yerdeki tüketici sorunları hakem heyetine veya tüketici mahkemesine yapılacaktır.

                    Siparişin gerçekleşmesi durumunda ALICI işbu sözleşmenin tüm koşullarını kabul etmiş sayılır.
                </pre>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabId) {
            const kvkkTab = document.getElementById('kvkk-tab');
            const mesafeliTab = document.getElementById('mesafeli-tab');
            const kvkkContent = document.getElementById('kvkk-content');
            const mesafeliContent = document.getElementById('mesafeli-content');

            if (tabId === 'kvkk') {
                kvkkTab.classList.add('tab-button-active');
                kvkkTab.classList.remove('tab-button-inactive');
                mesafeliTab.classList.add('tab-button-inactive');
                mesafeliTab.classList.remove('tab-button-active');
                kvkkContent.classList.remove('hidden');
                mesafeliContent.classList.add('hidden');
            } else {
                mesafeliTab.classList.add('tab-button-active');
                mesafeliTab.classList.remove('tab-button-inactive');
                kvkkTab.classList.add('tab-button-inactive');
                kvkkTab.classList.remove('tab-button-active');
                mesafeliContent.classList.remove('hidden');
                kvkkContent.classList.add('hidden');
            }
        }
    </script>
@endsection
