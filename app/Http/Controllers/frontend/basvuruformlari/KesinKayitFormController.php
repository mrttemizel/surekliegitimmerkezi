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
use Illuminate\Support\Facades\Log;

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
                // Word dokümanını düzenle
                $templateProcessor = new TemplateProcessor(public_path('word-templates/MesafeliSatis.docx'));
                
                // Değişkenleri tek tek kontrol ederek ve temizleyerek set edelim
                $values = [
                    'AdSoyad' => htmlspecialchars(mb_strtoupper($data->name . ' ' . $data->surname, 'UTF-8')),
                    'Adres' => htmlspecialchars($data->address),
                    'Telefon' => htmlspecialchars($data->phone),
                    'Eposta' => htmlspecialchars($data->email),
                    'EAdi' => htmlspecialchars($kurs->egitim_adi),
                    'EIcerik' => htmlspecialchars($kurs->detay),
                    'EFiyat' => htmlspecialchars(number_format($kurs->fiyat, 2, ',', '.') . ' TL'),
                    'EType' => htmlspecialchars($kurs->egitim_platformu),
                    'ESayi' => '1'
                ];

                Log::info('Template değerleri:', $values);

                // Her bir değeri ayrı ayrı set et ve kontrol et
                foreach ($values as $key => $value) {
                    try {
                        $templateProcessor->setValue($key, $value);
                        Log::info("Değer başarıyla set edildi: {$key}");
                    } catch (\Exception $e) {
                        Log::error("Değer set edilirken hata: {$key}", [
                            'error' => $e->getMessage()
                        ]);
                        throw new \Exception("'{$key}' değeri set edilirken hata oluştu");
                    }
                }
                
                // Dokümanı kaydet
                $fileName = Str::slug($data->name . '-' . $data->surname) . '-' . uniqid() . '.docx';
                $filePath = public_path('mesafeli-satis-sozlesmeleri/' . $fileName);
                $fileUrl = url('mesafeli-satis-sozlesmeleri/' . $fileName);
                
                // Klasör kontrolü
                $directory = public_path('mesafeli-satis-sozlesmeleri');
                if (!file_exists($directory)) {
                    if (!mkdir($directory, 0755, true)) {
                        throw new \Exception('Klasör oluşturulamadı');
                    }
                }
                
                // Dosyayı kaydetmeyi dene
                try {
                    $templateProcessor->saveAs($filePath);
                    Log::info('Dosya başarıyla kaydedildi', ['path' => $filePath]);
                } catch (\Exception $e) {
                    Log::error('Dosya kaydedilirken hata', [
                        'error' => $e->getMessage(),
                        'path' => $filePath
                    ]);
                    throw new \Exception('Dosya kaydedilemedi');
                }

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
