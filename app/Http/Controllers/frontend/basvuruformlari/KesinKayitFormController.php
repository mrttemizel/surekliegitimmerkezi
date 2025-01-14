<?php

namespace App\Http\Controllers\frontend\basvuruformlari;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\KesinKayitForm;
use App\Models\Siniflar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\KesinKayitBilgilendirme;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Facades\Log;
use Mpdf\Mpdf;

class KesinKayitFormController extends Controller
{

    public function kesinKayitForm($slug)
    {
        $data = Courses::where('slug', $slug)
            ->firstOrFail();

        $siniflar = Siniflar::where('egitim_id', $data->id)->get();

        return view('frontend.basvuruformlari.kesin-kayit-form', compact('data', 'siniflar'));
    }


    public function storeKesinKayitForm(Request $request)
    {
        $class = $request->input('sinif');
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'kvkk' => 'required',
            'tc' => 'required',
            'address' => 'required',
            'explicit' => 'required',
        ]);

        $kurs = Courses::where('id', $request->id)->firstOrFail();
        $data = new KesinKayitForm();

        $data->name = mb_strtoupper($request->input('name'), 'UTF-8');
        $data->surname = mb_strtoupper($request->input('surname'), 'UTF-8');
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
        $data->tc = $request->input('tc');
        $data->address = $request->input('address');

        $data->kvkk = $request->input('kvkk') === 'on' ? 'on' : 'off';
        $data->electronic = $request->input('electronic') === 'on' ? 'on' : 'off';
        $data->explicit = $request->input('explicit') === 'on' ? 'on' : 'off';

        $timestamp = Carbon::now()->format('YmdHis');

        if ($request->hasFile('kimlik')) {
            $request->validate([
                'kimlik' => 'required|file|mimes:pdf|max:2048',
            ]);
            $file = $request->file('kimlik');
            $kimlikname = Str::slug($request->input('name')).'-' . 'kimlik' .'-' . $timestamp .'.'.$file->getClientOriginalExtension();
            $file->move(public_path('kesin-kayit-evraklari'), $kimlikname);
            $data->kimlik = $kimlikname;
        }

        if ($request->hasFile('diploma')) {
            $request->validate([
                'diploma' => 'required|file|mimes:pdf|max:2048',
            ]);
            $file = $request->file('diploma');
            $diplomaname = Str::slug($request->input('name')).'-' . 'diploma' .'-' . $timestamp .'.'.$file->getClientOriginalExtension();
            $file->move(public_path('kesin-kayit-evraklari'), $diplomaname);
            $data->diploma = $diplomaname;
        }
        if ($request->hasFile('kurumkarti')) {
            $request->validate([
                'kurumkarti' => 'required|file|mimes:pdf|max:2048',
            ]);
            $file = $request->file('kurumkarti');
            $kurumkartimaname = Str::slug($request->input('name')).'-' . 'kurum-karti' .'-' . $timestamp .'.'.$file->getClientOriginalExtension();
            $file->move(public_path('kesin-kayit-evraklari'), $kurumkartimaname);
            $data->kurumkarti = $kurumkartimaname;
        }

        $data->kurs_id = $request->input('id');
        $data->kurs_adi = $kurs->egitim_adi;
        $data->sinif_id = $class;

        $query = $data->save();

        if (!$query) {
            return back()->with('error', 'Eklenirken bir hata oluştu!');
        } else {
            try {
                // PDF şablonunu yükle
                $pdf = new Fpdi();
                $pdf->AddFont('arial', '', 'arial.php');
                $pdf->SetFont('arial', '', 10);
                
                // Değişkenleri hazırla ve Türkçe karakterleri düzelt
                $values = [
                    'AdSoyad' => iconv('utf-8', 'windows-1254', mb_strtoupper($data->name . ' ' . $data->surname, 'UTF-8')),
                    'Adres' => iconv('utf-8', 'windows-1254', $data->address),
                    'Telefon' => iconv('utf-8', 'windows-1254', $data->phone),
                    'Eposta' => iconv('utf-8', 'windows-1254', $data->email),
                    'EAdi' => iconv('utf-8', 'windows-1254', $kurs->egitim_adi),
                    'EIcerik' => iconv('utf-8', 'windows-1254', $kurs->detay),
                    'EFiyat' => iconv('utf-8', 'windows-1254', number_format($kurs->fiyat, 2, ',', '.') . ' TL'),
                    'EFiyatTop' => iconv('utf-8', 'windows-1254', number_format($kurs->fiyat, 2, ',', '.') . ' TL (KDV Dahil) '),
                    'EType' => iconv('utf-8', 'windows-1254', $kurs->egitim_platformu),
                    'ESayi' => '1'
                ];

                // Font boyutlarını ayarla
                $fontSizes = [
                    'default' => 12,
                    'EAdi' => strlen($kurs->egitim_adi) > 50 ? 8 : (strlen($kurs->egitim_adi) > 30 ? 10 : 12)
                ];

                // Koordinatları ayarla
                $coordinates = [
                    // 1. sayfa koordinatları
                    'page1' => [
                        'AdSoyad' => [45, 82],
                        'Adres' => [45, 91],
                        'Telefon' => [45, 100],
                        'Eposta' => [45, 108],
                        'EAdi' => [35, 262],
                        'EFiyat' => [35, 272],
                        'EType' => [65, 272]
                    ],
                    // 2. sayfa koordinatları
                    'page2' => [
                        'EAdi' => [35, 240],    // Hizmet Açıklaması
                        'ESayi' => [79, 250],   // Adet (1)
                        'EFiyat' => [100, 250],  // Birim Fiyatı
                        'EFiyatTop' => [130, 250]  // Ara Toplam
                    ],
                    // 5. sayfa koordinatları - imza bölümü
                    'page5' => [
                        'AdSoyad' => [130, 35]  // İmza bölümündeki ad soyad
                    ]
                ];
                
                // PDF şablonunu import et
                $pageCount = $pdf->setSourceFile(public_path('word-templates/MesafeliSatis.pdf'));
                
                // Tüm sayfaları import et
                for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                    $templateId = $pdf->importPage($pageNo);
                    $pdf->AddPage();
                    $pdf->useTemplate($templateId);
                    
                    if ($pageNo == 1) {
                        foreach ($coordinates['page1'] as $key => $pos) {
                            // Her alan için font boyutunu ayarla
                            $fontSize = isset($fontSizes[$key]) ? $fontSizes[$key] : $fontSizes['default'];
                            $pdf->SetFontSize($fontSize);
                            
                            $pdf->SetXY($pos[0], $pos[1]);
                            $pdf->Write(0, $values[$key]);
                        }
                    } 
                    elseif ($pageNo == 2) {
                        foreach ($coordinates['page2'] as $key => $pos) {
                            // Her alan için font boyutunu ayarla
                            $fontSize = isset($fontSizes[$key]) ? $fontSizes[$key] : $fontSizes['default'];
                            $pdf->SetFontSize($fontSize);
                            
                            $pdf->SetXY($pos[0], $pos[1]);
                            if ($key == 'ESayi') {
                                $pdf->Write(0, '1');
                            } else {
                                $pdf->Write(0, $values[$key]);
                            }
                        }
                    }
                    elseif ($pageNo == 5) {
                        foreach ($coordinates['page5'] as $key => $pos) {
                            // Her alan için font boyutunu ayarla
                            $fontSize = isset($fontSizes[$key]) ? $fontSizes[$key] : $fontSizes['default'];
                            $pdf->SetFontSize($fontSize);
                            
                            $pdf->SetXY($pos[0], $pos[1]);
                            $pdf->Write(0, $values[$key]);
                        }
                    }
                    
                    // Her sayfanın sonunda varsayılan font boyutuna geri dön
                    $pdf->SetFontSize($fontSizes['default']);
                }

                // Dosyayı kaydet
                $fileName = Str::slug($data->name . '-' . $data->surname) . '-' . uniqid() . '.pdf';
                $filePath = public_path('mesafeli-satis-sozlesmeleri/' . $fileName);
                $fileUrl = url('mesafeli-satis-sozlesmeleri/' . $fileName);

                // Klasör kontrolü
                $directory = public_path('mesafeli-satis-sozlesmeleri');
                if (!file_exists($directory)) {
                    if (!mkdir($directory, 0755, true)) {
                        throw new \Exception('Klasör oluşturulamadı');
                    }
                }

                // PDF'i kaydet
                $pdf->Output($filePath, 'F');

                Log::info('PDF dokümanı oluşturuldu', [
                    'file_path' => $filePath,
                    'file_url' => $fileUrl,
                    'page_count' => $pageCount
                ]);

                // Mail gönderme işlemi
                $mailData = [
                    'name' => $data->name,
                    'surname' => $data->surname,
                    'kurs_adi' => $data->kurs_adi,
                    'sozlesme_url' => $fileUrl
                ];

                Mail::to($data->email)->send(new KesinKayitBilgilendirme($mailData));

                return back()->with('success', 'Kesin Kayıt Başvurunuz Başarılı Bir Şekilde Alınmıştır.')
                            ->with('sozlesme_url', $fileUrl);

            } catch (\Exception $e) {
                Log::error('Kritik hata', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                return back()->with('error', 'İşlem sırasında bir hata oluştu: ' . $e->getMessage());
            }
        }
    }
}
