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
          <!--  <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab" aria-controls="tab2" aria-selected="false">Mesafeli Satış Sözleşmesi</button>
            </li>-->
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3" type="button" role="tab" aria-controls="tab3" aria-selected="false">SEM WEB SİTESİ VE PORTAL KULLANIMI HAKKINDA</button>
            </li>

        </ul>

        <!-- Sekme İçerikleri -->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                <div style="white-space: pre-wrap; word-wrap: break-word;">
                    KİŞİSEL VERİLERİ KORUMA POLİTİKASI,
                    KİŞİSEL VERİLEN İŞLENMESİNE İLİŞKİN AYDINLATMA METNİ

                    <!-- ... önceki metin aynı ... -->

                    3. Kişisel Verilerin Toplanması, İşlenmesi ve İşleme Amaçları

                    Kişisel verileriniz, ABÜSEM tarafından sağlanan hizmet ve ticari faaliyetlere bağlı olarak değişkenlik gösterebilmekle birlikte; otomatik ya da otomatik olmayan yöntemlerle, Antalya Bilim Üniversitesi birimleri, internet sitesi, sosyal medyası, mobil uygulamalar ve benzeri vasıtalarla sözlü, yazılı ya da elektronik olarak toplanabilecektir.
                    ABÜSEM'in sunduğu hizmetlerden yararlandığınız sürece kişisel verileriniz işbu metinde belirtilen amaçlarla işlenebilecektir.
                </div>

                <div class="table-responsive mt-4">
                    <table class="table" style="width: 100%; border: 3px solid black; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th style="border: 2px solid black; padding: 15px; text-align: center; background-color: #f8f9fa;">VERİ</th>
                                <th style="border: 2px solid black; padding: 15px; text-align: center; background-color: #f8f9fa;">FAALİYET</th>
                                <th style="border: 2px solid black; padding: 15px; text-align: center; background-color: #f8f9fa;">AMAÇ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">AD-SOYAD</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">KURSİYER KAYIT</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: left;">
                                    • EĞİTİM FAALİYETLERİNİN YÜRÜTÜLMESİ<br>
                                    • YENİ EĞİTİM TARİHLERİNİN BİLDİRİLMESİ<br>
                                    • E DEVLETTE SERTİFİKA OLUŞTURULMASI
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">TC KİMLİK NO</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">KURSİYER KAYIT</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: left;">
                                    • EĞİTİM FAALİYETLERİNİN YÜRÜTÜLMESİ<br>
                                    • E DEVLETTE SERTİFİKA OLUŞTURULMASI
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">FİZİKSEL ADRES</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">SERTİFİKA TESLİMİ</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: left;">
                                    • KARGO - POSTA
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">E-POSTA</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">ONLİNE EĞİTİM</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: left;">
                                    • İLETİŞİM<br>
                                    • YENİ EĞİTİM TARİHLERİNİN BİLDİRİLMESİ
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">TELEFON</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">BİLDİRİMLER</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: left;">
                                    • İLETİŞİM<br>
                                    • YENİ EĞİTİM TARİHLERİNİN BİLDİRİLMESİ
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">KURUM KARTI</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">KURSİYER KAYIT</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: left;">
                                    • EĞİTİM FİYAT İNDİRİMİ
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">PASAPORT</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">KURSİYER KAYIT</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: left;">
                                    • YABANCI ÖĞRENCİ EĞİTİM FAALİYETLERİNİN YÜRÜTÜLMESİ
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">İMZA</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">EĞİTİM DEVAM KONTROLÜ</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: left;">
                                    • EĞİTİM KATILIMININ TESPİTİ
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">VİZE</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">KURSİYER KAYIT</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: left;">
                                    • YABANCI ÖĞRENCİ EĞİTİM FAALİYETLERİNİN YÜRÜTÜLMESİ
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">IP ADRESİ</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">SEM WEB SİTESİ</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: left;">
                                    • COĞRAFİ KONUM<br>
                                    • DİL/YERELLEŞTİRME<br>
                                    • GÜVENLİK AMAÇLARI
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">GOOGLE</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">SEM WEB SİTESİ</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: left;">
                                    • GOOGLE ANALYTICS RAPORLAMA<br>
                                    • KULLANICI DENEYİMİ İYİLEŞTİRME<br>
                                    • PAZARLAMA STRATEJİLERİ OPTİMİZASYONU
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div style="white-space: pre-wrap; word-wrap: break-word; margin-top: 20px;">
                Ayrıca, ABÜSEM’in hizmetlerini kullanmak amacıyla çağrı merkezlerimizi veya internet sayfamızı kullandığınızda, ABÜSEM binasını veya internet sitemizi ziyaret ettiğinizde, ABÜSEM tarafından düzenlenen eğitim, seminer veya organizasyonlara katıldığınızda kişisel verileriniz işlenebilecektir. Kişisel verileriniz, her türlü sözlü, yazılı ya da elektronik ortamda, otomatik veya otomatik olmayan yollar ile yukarıda yer verilen gerekçeler doğrultusunda ABÜSEM tarafından düzenlenen eğitim, seminer, organizasyonlar veya hizmetlerin belirlenen yasal çerçevede sunulabilmesi ve bu kapsamda ABÜSEM’in sözleşme ve yasadan doğan yükümlülüklerini eksiksiz ve doğru bir şekilde ifa edilebilmesi için elde ile edilir.
ABÜSEM tarafından sunulan eğitim ve hizmetlerden sizleri faydalandırmak için gerekli çalışmaların iş birimlerimiz tarafından yapılması, ABÜSEM tarafından sunulan eğitim ve hizmetlerin sizlerin beğeni, kullanım alışkanlıkları ve ihtiyaçlarına göre özelleştirilerek sizlere önerilmesi, ABÜSEM ile iş ilişkisi içerisinde olan üçüncü şahısların hukuki ve ticari güvenliğinin temini amaçlarıyla bilgi toplanmaktadır.
Bu hukuki sebeplerle toplanan kişisel verileriniz KVK Kanunu’nun 5. ve 6. maddelerinde belirtilen kişisel veri işleme şartları ve amaçları kapsamında, bu metnin üçüncü ve dördüncü maddelerinde belirtilen gerekçelerle işlenebilmekte ve aktarılabilmektedir.
4. İşlenen Kişisel Verilerin Kimlere ve Hangi Amaçla Aktarılabileceği
Kişisel verileriniz adli ya da idari mercilerce öngörülmesi hali dışında işbu metinde belirtilenler haricinde üçüncü kişilerle paylaşılmayacaktır.
Kişisel verilerinizi,
– Hukuk eğitimlerinin gerçekleştirilebilmesi için Adalet Bakanlığıyla,
– Sağlık eğitimlerinin gerçekleştirilebilmesi için Sağlık Bakanlığıyla,
–  Sertifikaların oluşturulması için E-Devlet ile,
– ABÜSEM için destek hizmetleri sağlayan, sitelerimizi barındıran veya işleten; verileri analiz eden hizmet sağlayıcıları (Google), eğitimlerin sizlere ulaştırılmasına yardımcı olan hizmet sağlayıcıları, müşteri hizmetleri sunan, ödemeleri yöneten hizmet sağlayıcıları vb.- üçüncü kişiler ile,
– Kanunen yetkili kamu kurumları ile
KVK Kanunu’nun 8. ve 9. maddelerinde belirtilen kişisel veri işleme şartları ve amaçları çerçevesinde paylaşabiliriz.
İlgili üçüncü kişiler, söz konusu hizmeti yerine getirebilmek için gerekli olan ilgili kişisel veriye erişim sağlamaktadır. Bu durumda, söz konusu üçüncü kişiler, bilgilerinizi yalnızca ABÜSEM adına hizmet vermek için kullanacak, sözleşmesel yükümlülükleri çerçevesinde bu bilgileri gizli tutmak ve başka hiçbir amaçla kullanmama yükümlülüğü altında olacaklardır.
ABÜSEM, size ait bilgileri güvenli biçimde saklamakta ve gerekli tüm önlemleri almaktadır. ABÜSEM' in, gerekli hizmeti size ulaştırmak için bilgilerinize erişimi olan sözleşme ortakları, sözleşme yükümlülükleri çerçevesinde bu bilgileri gizli tutmak ve başka hiçbir amaçla kullanmamakla yükümlüdür. Bu metnin üçüncü ve dördüncü maddelerinde belirtilen nedenlerle kişisel bilgilerinizin bir kısmı veya tamamı ilgili kamu kurum veya kuruluşlar ile paylaşılması gerekecektir. Bu durumlarda da bilgileriniz gizli addedilecektir.
5. Kişisel Veri Sahibinin KVK Kanunu’nun 11. Maddesinde Sayılan Hakları
Kişisel veri sahipleri olarak, haklarınıza ilişkin taleplerinizi, işbu Metin’nde aşağıda düzenlenen yöntemlerle ABÜSEM’e iletmeniz durumunda ABÜSEM talebin niteliğine göre talebinizi mümkün olan en kısa sürede ve en geç otuz gün içinde sonuçlandıracaktır.
Başkalarının gizliliğini tehlikeye atan veya başka şekilde aşırı derecede zor olan istekleri reddetme hakkımız bulunmaktadır. Talep ettiğiniz işlemin ayrıca bir maliyeti gerektirmesi hâlinde, Kişisel Verileri Koruma Kurulu tarafından belirlenen ücret tarifesi üzerinden ücret talep etme hakkımız saklıdır.
Bu kapsamda kişisel veri sahiplerinin;
-	Kişisel veri işlenip işlenmediğini öğrenme,
-	Kişisel verileri işlenmişse buna ilişkin bilgi talep etme,
-	Kişisel verilerin işlenme amacını ve bunların amacına uygun kullanılıp kullanılmadığını öğrenme,
-	Yurt içinde veya yurt dışında kişisel verilerin aktarıldığı üçüncü kişileri bilme,
-	Kişisel verilerin eksik veya yanlış işlenmiş olması hâlinde bunların düzeltilmesini isteme ve bu kapsamda yapılan işlemin kişisel verilerin aktarıldığı üçüncü kişilere bildirilmesini isteme,
-	KVK Kanunu’nun ve ilgili diğer kanun hükümlerine uygun olarak işlenmiş olmasına rağmen, işlenmesini gerektiren sebeplerin ortadan kalkması hâlinde kişisel verilerin silinmesini veya yok edilmesini isteme ve bu kapsamda yapılan işlemin kişisel verilerin aktarıldığı üçüncü kişilere bildirilmesini isteme,
-	İşlenen verilerin münhasıran otomatik sistemler vasıtasıyla analiz edilmesi suretiyle kişinin kendisi aleyhine bir sonucun ortaya çıkmasına itiraz etme,
-	Kişisel verilerin kanuna aykırı olarak işlenmesi sebebiyle zarara uğraması hâlinde zararın giderilmesini talep etme haklarına sahiptir.

6. Kişisel Veri Sahibinin Başvuru Hakkı
KVK Kanunu’nun 13. maddesinin 1. fıkrası gereğince, yukarıda belirtilen haklarınızı kullanmak için kimliğinizi tespit edici gerekli bilgiler (3. kişiler adına yapılan başvurular için özel vekâletnameleri) ile kimliğinizi tespit edici gerekli bilgiler ve talep olunan diğer bilgiler ile KVK Kanunu’nun 11. maddesinde belirtilen haklardan kullanmayı talep ettiğiniz hakkınıza yönelik açıklamalarınızı içeren talebinizi sem@antalya.edu.tr e-posta adresinden veya aşağıdaki adrese bizzat elden veya noter vasıtasıyla tebligat yoluyla veya Kişisel Verileri Koruma Kurulu tarafından belirlenen diğer yöntemlerle iletebilirsiniz.

Antalya Bilim Üniversitesi Sürekli Eğitim Uygulama ve Araştırma Merkezi (ABÜSEM)
Adres: Tahılpazarı Mah. Adnan Menderes Blv. No.84 MarkAntalya AVM üzeri 7. Kat Muratpaşa/Antalya

7. Kişisel Verilen İşlenmesine İlişkin Aydınlatma Metni’nin Güncellenmesi
ABÜSEM olarak, KVK Kanunu’nda herhangi bir değişiklik yayınlanması halinde işbu Kişisel Verileri Koruma Politikası Kişisel Verilen İşlenmesine İlişkin Aydınlatma Metni’ni güncelleyeceğimizi taahhüt ederiz. ABÜSEM, Kişisel Verileri Koruma Politikası Kişisel Verilen İşlenmesine İlişkin Aydınlatma Metni hükümlerini dilediği zaman sitede yayınlamak veya kullanıcılara elektronik posta göndermek suretiyle değiştirebilir. Kişisel Verileri Koruma Politikası Kişisel Verilen İşlenmesine İlişkin Aydınlatma Metni hükümleri değiştiği takdirde, yayınlandığı tarihte yürürlük kazanır.


                </div>
            </div>
            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                <pre>
                   MESAFELİ SATIŞ SÖZLEŞMESİ
                MADDE 1. TARAFLAR
                (1) İşbu Mesafeli Satış Sözleşmesi (bundan sonra “Sözleşme” olarak anılacaktır) aşağıdaki taraflar arasında aşağıda belirtilen hüküm ve şartlar çerçevesinde imzalanmıştır.
                ALICI:
                 Anasayfa | ABU - Sürekli Eğitim Merkezi sitesinden (bundan sonra “SİTE” olarak anılacaktır) eğitim hizmeti satın alan tüketicidir (Sözleşmede bundan sonra "ALICI" olarak anılacaktır).
                Ad-Soyad:
                Adres:
                Telefon:
                E-posta
                SAĞLAYICI:
                Mesleki faaliyetleri kapsamında tüketiciye hizmet sunan tüzel kişidir (Sözleşmede bundan sonra " SAĞLAYICI " olarak anılacaktır).
                Unvanı: Antalya Bilim Üniversitesi
                Adres: Tahılpazarı Mah. Adnan Menderes Bulvarı No:84 Muratpaşa / ANTALYA
                Telefon: 0242 245 02 45
                E-Posta: sem@antalya.edu.tr
                Faks: 0 242 245 01 00
                (2) İş bu sözleşmeyi kabul etmekle ALICI, sözleşme konusu hizmeti satın aldığı takdirde sipariş konusu eğitim hizmetinin bedeli, vergi gibi belirtilen ek ücretleri ödeme yükümlülüğü altına gireceğini ve bu konuda bilgilendirildiğini kabul, beyan ve taahhüt eder. SAĞLAYICI ise işbu sözleşmede belirtilen şartlara usul ve esaslara uygun olarak eğitim hizmetini ALICI’ya sunacağını kabul, beyan ve taahhüt eder. ALICI ve SAĞLAYICI ayrı ayrı taraf ve birlikte taraflar olarak anılabilecektir.
                MADDE 2. SÖZLEŞMENİN KONUSU
                (1) İşbu Sözleşme, ALICI’nın, SAĞLAYICI’ya ait SİTE üzerinden elektronik ortamda siparişini verdiği aşağıda nitelikleri ve satış fiyatı belirtilen eğitim hizmetine ilişkin 6502 sayılı Tüketicinin Korunması Hakkında Kanun ve Mesafeli Sözleşmeler Yönetmeliği hükümleri gereğince tarafların hak ve yükümlülüklerini düzenler.
                Eğitim Hizmetinin Bilgileri:
                 (2) SAĞLAYICI tarafından verilen tüm eğitimlerin fiyatları SİTE’ de yayımlanmıştır. Listelenen ve SİTE’ de ilan edilen fiyatlar eğitimlerin satış fiyatıdır. İlan edilen fiyatlar ve vaatler güncelleme yapılana ve değiştirilene kadar geçerlidir. Süreli olarak ilan edilen fiyatlar ise belirtilen süre sonuna kadar geçerlidir.
                (3) Sözleşme kapsamında SAĞLAYICI, ALICI’ ya, işbu sözleşmede belirtilen bedel karşılığında SİTE üzerinden çevrimiçi / örgün eğitim hizmeti sunacaktır.
                MADDE 3. SÖZLEŞME KONUSU HİZMET BİLGİLERİ
                (1)
                (2) Ödeme Şekli: ALICI SİTE üzerinden eğitim hizmetini kredi kartıyla tek çekim veya taksitli bir şekilde satın alınabilir veya Antalya Bilim Üniversitesi kurumsal hesap numarasına tek seferde tüm hizmet bedelini https://testsem.antalya.edu.tr/hakkimizda/banka-hesap-bilgileri link kısmında bulunan hesap bilgilerine eft/havale yöntemi ile ödeyerek satın alınabilir.
                (3) Eğitime erişim şekli: Eğitimler online veya örgün olarak ifa edildiği için eğitimlere erişime ilişkin gerekli olan bilgiler ALICI’nın kayıt formunu doldururken belirttiği cep telefonu numarasına (SMS ile veya Whatapp uygulaması üzerinden ALICI’ya doğrudan veya Whatapp eğitim grubuna mesaj atılarak) veya e-posta adresine, hizmet bedelinin SAĞLAYICI’ya ulaşmasından sonra gönderilecektir.
                MADDE 4. HİZMET BEDELİ
                (1) Sözleşme konusu mal ya da hizmetin tüm vergiler dâhil satış fiyatı aşağıda gösterilmiştir. Listelenen ve SİTE’de ilan edilen fiyatlar satış fiyatıdır. İlan edilen fiyatlar ve vaatler güncelleme yapılana ve değiştirilene kadar geçerlidir. Süreli olarak ilan edilen fiyatlar ise belirtilen süre sonuna kadar geçerlidir.
                (2) Sözleşme konusu mal ya da hizmetin tüm vergiler dâhil satış fiyatı aşağıda gösterilmiştir.
                Hizmet Açıklaması	Adet	Birim Fiyatı	Ara Toplam (KDV Dahil)





                MADDE 5. FATURA BİLGİLERİ
                (1) Fatura hizmet bedelinin ödenmesi sonrasında, ALICI tarafından belirtilen e-posta adresine ilgili grubun eğitimi tamamlandıktan sonra gönderilecektir. Faturanın düzenlenmesine ilişkin bilgilerde ALICI’nın sipariş esnasında SİTE’de belirtmiş olduğu kişisel bilgiler kullanılacaktır. ALICI kurumsal fatura oluşturmak istemesi halinde sipariş esnasında, SEM e-posta veya SEM telefonu ile iletişim kurarak SAĞLAYICI’ ya bilgi vermelidir.


                MADDE 6. GENEL HÜKÜMLER
                (1) ALICI, SAĞLAYICI’ya ait SİTE’den sözleşme konusu hizmete ilişkin temel nitelikleri, hizmet bedeli, ödeme şekli, cayma hakkının kullanılabileceği ve kullanılamayacağı şartlara ilişkin ön bilgileri okuyup, bilgi sahibi olduğunu, elektronik ortamda gerekli teyidi verdiğini kabul, beyan ve taahhüt eder.
                (2) ALICI kayıt esnasında gerekli bilgileri, tam ve doğru belirtmek zorundadır. Bilgilerin yanlış belirtilmesi halinde SAĞLAYI’nın sorumluluğu doğmayacaktır.
                MADDE 7. CAYMA HAKKI
                (1) Eğitimin online olarak sunulması halinde sözleşme konusu hizmetin elektronik ortamda anında ifa edilmesi nedeniyle, ALICI sözleşme konusu olan eğitime giriş yaptıktan sonra ve her halde işbu sözleşmenin kurulduğu günden itibaren on dört gün geçmesiyle cayma hakkını kullanamayacaktır.
                (2) Eğitimin örgün olarak sunulması halinde ALICI işbu sözleşmenin kurulduğu günden itibaren on dört gün içinde herhangi bir gerekçe göstermeksizin ve cezai şart ödemeksizin sözleşmeden cayma hakkına sahiptir.
                (3) ALICI SİTE’de bulunan, Genel Amaçlı Dilekçe Formlar | ABU - Sürekli Eğitim Merkezi linkinden erişilebilecek Genel Amaçlı Dilekçe formunu doldurarak SAĞLAYICI’ ya açık bir beyanla yazılı olarak veya sem@antalya.edu.tr adresine e-posta atarak cayma talebinde bulunabilir. Dilekçe Antalya SEM Müdürlüğü tarafından incelenecek ve uygun görülmesi halinde ALICI bilgilendirilecektir.
                (4) Bu durumda SAĞLAYICI, ALICI’nın iletmiş olduğu cayma taleplerinin kendilerine ulaştığına ilişkin teyit bilgisini ALICI’ya iletecektir.
                (5) ALICI’nın cayma hakkını kullanması durumunda işbu sözleşme kendiliğinden sona erer.
                MADDE 8. İADE PROSEDÜRÜ
                (1) SAĞLAYICI, ALICI’nın işbu sözleşmenin 7. maddesinde belirtilen usul ve esaslara uygun olarak cayma hakkını kullandığı bildiriminin kendisine ulaşmasından itibaren on dört gün içerisinde ALICI’dan tahsil edilen hizmet bedelini ve ALICI’dan aldığı tüm ödemeleri ALICI’ya iade edecektir.
                (2) Hizmet bedelinin iadesinin yapılması ile ALICI’ya iletilen eğitime giriş bilgileri inaktif hale getirilecek ve ALICI’nın erişimi kısıtlanacaktır.
                (3) SAĞLAYICI, tüm iade bedelini ALICI’nın hizmeti satın alırken kullandığı ödeme aracına uygun bir şekilde tek seferde yapacaktır.
                (4) İade prosedürü SİTE’de bulunan, Ücret İade Formları Sayfası | ABU - Sürekli Eğitim Merkezi linkinden erişilebilecek sayfada açıklanmıştır. ALICI bu sitede belirtilen prosedürü uygulamalıdır. ALICI, bu prosedürü okuduğunu ve kabul ettiğini taahhüt eder.
                (5) Kredi Kartına İade Prosedürü:
                ALICI'nın cayma hakkını kullandığı veya Tüketici Hakem Heyeti veya mahkeme kararı ile ALICI’ya bedel iadesine karar verilen durumlarda, ALICI’nın eğitim hizmetini satın alırken kullandığı kredi kartına ücret iadesi yapılacaktır. ALICI, bu prosedürü okuduğunu ve kabul ettiğini taahhüt eder.
                (6) Havale/Eft Ödeme Seçeneklerinde İade Prosedürü:
                ALICI’nın hizmet bedelini havale/EFT ödeme seçeneklerinden birisi ile ödemiş olması halinde ALICI’dan banka hesap bilgileri istenerek, ALICI’nın belirttiği hesaba (hesabın fatura adresindeki kişinin adına veya kullanıcı üyenin adına olması şarttır) Havale veya EFT şeklinde yapılacaktır.
                MADDE 9. TEMERRÜT HALİ VE HUKUKİ SONUÇLARI
                (1) ALICI, ödeme işlemlerini kredi kartı ile yaptığı durumda temerrüde düştüğü takdirde, kart sahibi banka ile arasındaki kredi kartı sözleşmesi çerçevesinde faiz ödeyeceğini ve bankaya karşı sorumlu olacağını kabul, beyan ve taahhüt eder. ALICI işbu sözleşme kapsamında borcunu ödemekte temerrüde düşmesi halinde, ALICI, borcun gecikmeli ifasından dolayı SAĞLAYICI’nın uğradığı zarar ve ziyanını ödeyeceğini kabul, beyan ve taahhüt eder.
                MADDE 10. UYUŞMAZLIK BAŞVURU USULÜ
                (1) İşbu sözleşmeden doğan uyuşmazlıklarda şikâyet ve itirazlar, şikâyet veya itirazın konusunun, şikâyet ve itirazın yapılacağı yıla göre tüketici uyuşmazlıklarının değerleri açısından her yıl Hazine ve Maliye Bakanlığı tarafından ilan edilen yeniden değerleme oranının altına kalması halinde tüketicinin yerleşim yerinin bulunduğu veya tüketici işleminin yapıldığı yerdeki tüketici hakem heyetine, parasal sınırın üstünde kalması halinde 6502 sayılı Kanun’un 73/A maddesi kapsamında sırasıyla dava şartı arabuluculuk müessesesine ve tüketici mahkemelerine yapılacaktır.
                MADDE 11. YÜRÜRLÜK
                (1) ALICI’nıın, SİTE üzerinden aldığı hizmet bedeline ilişkin ödemeyi gerçekleştirmesi ile işbu sözleşme yürürlüğe girer ve ALICI işbu sözleşmenin tüm şartlarını kabul etmiş sayılır.

                          SAĞLAYICI                                                                              ALICI
                 Antalya Bilim Üniversitesi

                </pre>
            </div>
            <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                <pre>
TÜRKİYE CUMHURİYETİ
ANTALYA BİLİM ÜNİVERSİTESİ SÜREKLİ EĞİTİM MERKEZİ
KİŞİSEL VERİ İŞLEME FAALİYETLERİNE DAİR RIZA METNİ
                    Antalya Bilim Üniversitesi Sürekli Eğitim Merkezi ile paylaşmış olduğum aşağıda sayılan kişisel verilerimin gene aşağıda gösterilmiş
                    olan amaçlar dâhilinde Antalya Bilim Üniversitesi tarafından işlenmesini ve Kişisel Verileri Koruma Politikası, Kişisel Verilen
                    İşlenmesine İlişkin Aydınlatma Metni'nde gösterilen kişi ve kurumlarla paylaşılmasını ve yurt dışına aktarılmasını kabul ediyorum.

AD-SOYAD:
İMZA:
                </pre>

                <div class="table-responsive mt-4">
                    <table class="table" style="width: 100%; border: 3px solid black; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th style="border: 2px solid black; padding: 15px; text-align: center; background-color: #f8f9fa;">VERİ</th>
                                <th style="border: 2px solid black; padding: 15px; text-align: center; background-color: #f8f9fa;">FAALİYET</th>
                                <th style="border: 2px solid black; padding: 15px; text-align: center; background-color: #f8f9fa;">AMAÇ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">AD-SOYAD</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">KURSİYER KAYIT</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: left;">
                                    • EĞİTİM FAALİYETLERİNİN YÜRÜTÜLMESİ<br>
                                    • YENİ EĞİTİM TARİHLERİNİN BİLDİRİLMESİ<br>
                                    • E DEVLETTE SERTİFİKA OLUŞTURULMASI
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">TC KİMLİK NO</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">KURSİYER KAYIT</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: left;">
                                    • EĞİTİM FAALİYETLERİNİN YÜRÜTÜLMESİ<br>
                                    • E DEVLETTE SERTİFİKA OLUŞTURULMASI
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">FİZİKSEL ADRES</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">SERTİFİKA TESLİMİ</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: left;">
                                    • KARGO - POSTA
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">E-POSTA</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">ONLİNE EĞİTİM</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: left;">
                                    • İLETİŞİM<br>
                                    • YENİ EĞİTİM TARİHLERİNİN BİLDİRİLMESİ
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">TELEFON</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">BİLDİRİMLER</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: left;">
                                    • İLETİŞİM<br>
                                    • YENİ EĞİTİM TARİHLERİNİN BİLDİRİLMESİ
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">KURUM KARTI</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">KURSİYER KAYIT</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: left;">
                                    • EĞİTİM FİYAT İNDİRİMİ
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">PASAPORT</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">KURSİYER KAYIT</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: left;">
                                    • YABANCI ÖĞRENCİ EĞİTİM FAALİYETLERİNİN YÜRÜTÜLMESİ
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">İMZA</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">EĞİTİM DEVAM KONTROLÜ</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: left;">
                                    • EĞİTİM KATILIMININ TESPİTİ
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">VİZE</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">KURSİYER KAYIT</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: left;">
                                    • YABANCI ÖĞRENCİ EĞİTİM FAALİYETLERİNİN YÜRÜTÜLMESİ
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">IP ADRESİ</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">SEM WEB SİTESİ</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: left;">
                                    • COĞRAFİ KONUM<br>
                                    • DİL/YERELLEŞTİRME<br>
                                    • GÜVENLİK AMAÇLARI
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">GOOGLE</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: center;">SEM WEB SİTESİ</td>
                                <td style="border: 2px solid black; padding: 15px; text-align: left;">
                                    • GOOGLE ANALYTICS RAPORLAMA<br>
                                    • KULLANICI DENEYİMİ İYİLEŞTİRME<br>
                                    • PAZARLAMA STRATEJİLERİ OPTİMİZASYONU
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
