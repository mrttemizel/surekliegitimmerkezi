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
        ]);

        $kurs = Courses::where('id',$request->id)->firstOrFail();
        $data = new KesinKayitForm();

        $data->name = mb_strtoupper($request->input('name'), 'UTF-8');
        $data->surname = mb_strtoupper($request->input('surname'), 'UTF-8');
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
        $data->tc = $request->input('tc');
        $data->address = $request->input('address');
        $data->kvkk = $request->input('kvkk') === 'on' ? 'on' : 'off';

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
        $data->sinif_id=$class;
        $query = $data->save();

        if (!$query) {
            return back()->with('error', 'Eklenirken bir hata oluştu!');
        } else {
            try {
                Log::info('Word dokümanı işlemi başlıyor', [
                    'user_email' => $data->email,
                    'template_path' => public_path('word-templates/Satis.docx')
                ]);

                // Word dokümanını düzenle
                $templateProcessor = new TemplateProcessor(public_path('word-templates/Satis.docx'));
                
                // Sadece Ad-Soyad değişkenini set et
                $templateProcessor->setValue('AdSoyad', mb_strtoupper($data->name . ' ' . $data->surname, 'UTF-8'));
                
                // Geçici dosya oluştur
                $tempFile = storage_path('app/public/temp/' . uniqid() . '_Satis.docx');
                $templateProcessor->saveAs($tempFile);

                Log::info('Word dokümanı oluşturuldu', [
                    'temp_file' => $tempFile
                ]);

                try {
                    // Mail gönderme işlemi
                    Mail::to($data->email)->send(new KesinKayitBilgilendirme([
                        'name' => $data->name,
                        'surname' => $data->surname,
                        'kurs_adi' => $data->kurs_adi,
                        'wordFile' => $tempFile
                    ]));

                    Log::info('Mail başarıyla gönderildi', [
                        'to' => $data->email
                    ]);
                } catch (\Exception $mailError) {
                    Log::error('Mail gönderme hatası', [
                        'error' => $mailError->getMessage(),
                        'trace' => $mailError->getTraceAsString()
                    ]);
                    throw $mailError;
                }

                // Geçici dosyayı sil
                if (file_exists($tempFile)) {
                    unlink($tempFile);
                    Log::info('Geçici dosya silindi');
                }

                return back()->with('success', 'Ön Başvurunuz Başarılı Bir Şekilde Alınmıştır.');
            } catch (\Exception $e) {
                Log::error('Genel hata', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                return back()->with('error', 'Mail gönderilirken bir hata oluştu: ' . $e->getMessage());
            }
        }
    }
}
