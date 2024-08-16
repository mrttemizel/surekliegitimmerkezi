<?php


namespace App\Services;

use App\DTO\barkodluBelgeDogrulaCType;
use App\Models\Courses;
use App\Models\KesinKayitForm;
use App\Models\Siniflar;
use SoapFault;
use App\DTO\Sertifika;
use App\DTO\SertifikaDetay;
use App\DTO\DetailType;
use App\DTO\SertifikaSorgulaC;
use App\DTO\DilType;
use App\DTO\DilSorgulaCType;
use App\DTO\UniversiteBelgeOlusturC;
use App\Http\Controllers\backend\sertifika\EDevletController;

class SertifikaService
{
    private $validCredentials = [
        'kullaniciAdi' => 'antalyabilim',
        'sifre' => '123456'
    ];


    private function validateCredentials($parameters)
    {
        return $parameters->kullaniciAdi === $this->validCredentials['kullaniciAdi'] &&
            $parameters->sifre === $this->validCredentials['sifre'];
    }

    public function sertifikaSorgula($parameters)
    {
        error_log(print_r($parameters, true));

        if (is_object($parameters) &&
            isset($parameters->kurumKodu) &&
            isset($parameters->kullaniciAdi) &&
            isset($parameters->sifre) &&
            isset($parameters->ipAdresi) &&
            isset($parameters->tcKimlikNo)) {
            $sertifikaList = [];
            $detayListesi = [];
            $sertifikaDetayList = [];
            if ($this->validateCredentials($parameters)) {
                $controller = new EDevletController();

                // Create a Request object
                $request = new \Illuminate\Http\Request(['tcKimlikNo' => $parameters->tcKimlikNo]);

                // Call the method with the Request object
                // $data = $controller->getCertificatesByTcKimlikNo($parameters->tcKimlikNo);
                $classLists = KesinKayitForm::where('tc', $parameters->tcKimlikNo)->get();
                if ($classLists->count() > 0) {
                    $classData = Siniflar::where('id', $classLists[0]->sinif_id)->get();
                    $course_data = Courses::where('id', $classLists[0]->kurs_id)->first();
                    $data = [];
                    $data['sertifika_id'] = $classLists[0]->id;

                    $data['sertifika_no'] = date('Y/m', strtotime($classLists[0]->created_at));
                    $data['tur'] = ($classData[0]->sertifika_tipi == 1) ? 'Sertifika Belgesi' : 'Katılım Belgesi';
                    $data['sertifika_adi'] = $course_data->egitim_adi;
                    $data['yer'] = $course_data->egitim_yeri;

                    $sertifikaList = [];
                    $detayListesi = [];

                    $sertifika = new Sertifika();
                    $sertifika->sertifikaID = $data['sertifika_id'];
                    $sertifika->sertifikaNumarasi = $data['sertifika_no'];
                    $sertifika->tur = $data['tur'];
                    $sertifika->sertifikaAdi = $data['sertifika_adi'];
                    $sertifika->alindigiYer = $data['yer'];
                    $sertifika->sertifikaGecerlilikTarih = '----';

                    $sertifikaDetayList = [];


                    $sertifika->sertifikaDetayListesi = $sertifikaDetayList;

                    $sertifikaList[] = $sertifika;

                    $detay = new DetailType();

                    $detayListesi[] = $detay;


                    $islemSonuc = new SertifikaSorgulaC();
                    $islemSonuc->kurumKodu = $parameters->kurumKodu;
                    $islemSonuc->sonucKodu = '0000';
                    $islemSonuc->sonucAciklamasi = 'Başarıyla gerçekleştirildi';
                    $islemSonuc->sertifikaListesi = $sertifikaList;
                    $islemSonuc->detayListesi = $detayListesi;

                    return $islemSonuc;
                } else {
                    return ['kurumKodu' => $parameters->kurumKodu, 'sonucKodu' => '0003', 'sonucAciklamasi' => 'Sonuç bulunamadı', 'sertifikaListesi' => '', 'detayListesi' => '', 'sertifikaDetayListesi' => ''];
                }
            } else {
                return ['kurumKodu' => $parameters->kurumKodu, 'sonucKodu' => '0001', 'sonucAciklamasi' => 'Yanlış kullanıcı adı veya şifre', 'sertifikaListesi' => '', 'sertifikaDetayListesi' => ''];
            }
        }
    }

    public function sertifikaBelgeIndir($parameters)
    {
        error_log(print_r($parameters, true));

        if (is_object($parameters) &&
            isset($parameters->kurumKodu) &&
            isset($parameters->kullaniciAdi) &&
            isset($parameters->sifre) &&
            isset($parameters->ipAdresi) &&
            isset($parameters->tcKimlikNo) &&
            isset($parameters->sertifikaID) &&
            isset($parameters->dilKey)) {

            if ($this->validateCredentials($parameters)) {
                $certLists = KesinKayitForm::where('id', $parameters->sertifikaID)
                    ->where('tc', $parameters->tcKimlikNo)
                    ->first();

                if ($certLists) {
                    $certificatePath = $certLists->sertificate;

                    if (file_exists(public_path($certificatePath))) {
                        $fileContent = file_get_contents(public_path($certificatePath));
                        $data['sertifika_base64'] = $fileContent;
                    } else {
                        $data['sertifika_base64'] = null;
                    }

                    $belgeContent = $data['sertifika_base64'];


                    $detayListesi = [];

                    $islemSonuc = new \stdClass();
                    $islemSonuc->kurumKodu = $parameters->kurumKodu;
                    $islemSonuc->sonucKodu = '0000';
                    $islemSonuc->sonucAciklamasi = 'Başarıyla gerçekleştirildi';
                    $islemSonuc->belge = $belgeContent;
                    $islemSonuc->detayListesi = $detayListesi;
                    return $islemSonuc;
                } else {
                    return [
                        'kurumKodu' => $parameters->kurumKodu,
                        'sonucKodu' => '0003',
                        'sonucAciklamasi' => 'Sonuç bulunamadı',
                        'belge' => ''
                    ];
                }
            } else {
                return [
                    'kurumKodu' => $parameters->kurumKodu,
                    'sonucKodu' => '0001',
                    'sonucAciklamasi' => 'Yanlış kullanıcı adı veya şifre',
                    'belge' => ''
                ];
            }
        } else {
            error_log("Gelen istek verisi eksik veya hatalı: " . print_r($parameters, true));
            throw new SoapFault('Server', 'Invalid input');
        }
    }

    public function dilSorgula($parameters)
    {
        error_log(print_r($parameters, true));

        if (is_object($parameters) &&
            isset($parameters->kurumKodu) &&
            isset($parameters->kullaniciAdi) &&
            isset($parameters->sifre) &&
            isset($parameters->ipAdresi) &&
            isset($parameters->belgeTur)) {

            if ($this->validateCredentials($parameters)){
                $dilListesi = [];

                    $dil = new DilType();
                    $dil->dilKey = 'tr';
                    $dil->dilValue = 'tr';
                    $dilListesi[] = $dil;

                $islemSonuc = new DilSorgulaCType();
                $islemSonuc->kurumKodu = $parameters->kurumKodu;
                $islemSonuc->sonucKodu = '0000';

                $islemSonuc->sonucAciklamasi = 'Başarıyla gerçekleştirildi';
                $islemSonuc->dilListesi = $dilListesi;

                return $islemSonuc;
            } else {
                return ['kurumKodu'=>$parameters->kurumKodu, 'sonucKodu'=>'0001','sonucAciklamasi'=>'Yanlış kullanıcı adı veya şifre','dilListesi'=>''];
            }
        } else {
            error_log("Gelen istek verisi eksik veya hatalı: " . print_r($parameters, true));
            throw new SoapFault('Server', 'Invalid input');
        }
    }

   /* public function universiteBelgeOlustur($parameters)
    {
        error_log(print_r($parameters, true));

        if (is_object($parameters) &&
            isset($parameters->kurumKodu) &&
            isset($parameters->kullaniciAdi) &&
            isset($parameters->sifre) &&
            isset($parameters->ipAdresi) &&
            isset($parameters->belgeTur)) {

            if ($this->validateCredentials($parameters)){
                $detayListesi = [];
                $detay = new \stdClass();
                $detay->group = 'Group2';
                $detay->key = 'Key2';
                $detay->value = 'Value2';

                $detayListesi[] = $detay;

                $islemSonuc = new universiteBelgeOlusturC();
                $islemSonuc->kurumKodu = $parameters->kurumKodu;
                $islemSonuc->sonucKodu = '0000';
                $islemSonuc->belge = 'hgfdhjdgjhjghjghjghj==';
                $islemSonuc->sonucAciklamasi = 'Başarıyla gerçekleştirildi';
                $islemSonuc->detayListesi = $detayListesi;

                return $islemSonuc;
            } else {
                return ['kurumKodu'=>$parameters->kurumKodu, 'sonucKodu'=>'0001','sonucAciklamasi'=>'Yanlış kullanıcı adı veya şifre','belge'=>''];
            }
        } else {
            error_log("Gelen istek verisi eksik veya hatalı: " . print_r($parameters, true));
            throw new SoapFault('Server', 'Invalid input');
        }
    }*/
    public function barkodluBelgeDogrulama($parameters) {
        error_log(print_r($parameters, true));

        if (is_object($parameters) &&
            isset($parameters->kurumKodu) &&
            isset($parameters->kullaniciAdi) &&
            isset($parameters->sifre) &&
            isset($parameters->ipAdresi) &&
            isset($parameters->tcKimlikNo) &&
            isset($parameters->barkodNo)) {

            if ($this->validateCredentials($parameters)) {
                $barkod_No=$parameters->barkodNo;
                $tc = substr($barkod_No, -11);
                $sertificate = KesinKayitForm::where('tc', $tc)
                    ->where('status',2)
                    ->first();
                if($sertificate and ($parameters->tcKimlikNo == $tc)) {
                    $pdfContent = file_get_contents(public_path($sertificate->sertificate));

                    $response = new barkodluBelgeDogrulaCType();
                    $response->kurumKodu = $parameters->kurumKodu;
                    $response->sonucKodu = '0000';
                    $response->sonucAciklamasi = 'Başarıyla gerçekleştirildi';

                    $response->belge = $pdfContent;
                    $response->tcKimlikNo = $tc;
                    $response->ad = $sertificate->name;
                    $response->soyad = $sertificate->surname;
                    $response->belgeOlusturulmaTarihi = date('Y/m/d', strtotime($sertificate->created_at));

                    $detayListesi = [];
                    $response->detayListesi = $detayListesi;

                    return $response;
                }else{
                    return [
                        'kurumKodu' => $parameters->kurumKodu,
                        'sonucKodu' => '0003',
                        'sonucAciklamasi' => 'Sonuç Bulunamadı.....',
                        'belge' => null,
                        'tcKimlikNo' => null,
                        'ad' => null,
                        'soyad' => null,
                        'belgeOlusturulmaTarihi' => null,
                        'detayListesi' => null
                    ];
                }
            } else {
                return [
                    'kurumKodu' => $parameters->kurumKodu,
                    'sonucKodu' => '0001',
                    'sonucAciklamasi' => 'Yanlış kullanıcı adı veya şifre',
                    'belge' => null,
                    'tcKimlikNo' => null,
                    'ad' => null,
                    'soyad' => null,
                    'belgeOlusturulmaTarihi' => null,
                    'detayListesi' => null
                ];
            }
        } else {
            error_log("Gelen istek verisi eksik veya hatalı: " . print_r($parameters, true));
            throw new SoapFault('Server', 'Invalid input');
        }
    }
}
