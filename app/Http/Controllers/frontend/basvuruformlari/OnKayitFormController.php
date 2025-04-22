<?php

namespace App\Http\Controllers\frontend\basvuruformlari;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\OnBasvuruForm;
use Illuminate\Http\Request;

class OnKayitFormController extends Controller
{
    public function onKayitForm($slug)
    {
        $data = Courses::where('slug', $slug)->firstOrFail();

        return view('frontend.basvuruformlari.on-kayit-form',compact('data'));
    }



    public function storeOnKayitForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'kvkk' => 'required',
            'explicit' => 'required',
            'electronic' => 'required',
        ]);

        // Zararlı karakterleri temizle ve kontrol et
        $name = $this->sanitizeInput($request->input('name'));
        $surname = $this->sanitizeInput($request->input('surname'));
        $email = filter_var($request->input('email'), FILTER_SANITIZE_EMAIL);
        $phone = preg_replace('/[^0-9\-\+\(\) ]/', '', $request->input('phone'));
        
        $kurs = Courses::where('id', $request->id)->firstOrFail();

        $data = new OnBasvuruForm();

        $data->name = mb_strtoupper($name, 'UTF-8');
        $data->surname = mb_strtoupper($surname, 'UTF-8');
        $data->email = $email;
        $data->phone = $phone;
        $data->kvkk = $request->input('kvkk') === 'on' ? 'on' : 'off';
        $data->electronic = $request->input('electronic') === 'on' ? 'on' : 'off';
        $data->explicit = $request->input('explicit') === 'on' ? 'on' : 'off';
        $data->kurs_id = $request->input('id');
        $data->kurs_adi = $kurs->egitim_adi;

        $query = $data->save();
        if (!$query) {
            return back()->with('error', 'Eklenirken bir hata oluştu!');
        } else {
            return back()->with('success', 'Ön Başvurunuz Başarılı Bir Şekilde Alınmıştır.');
        }
    }

    // Güvenli girdi temizleme fonksiyonu
    private function sanitizeInput($input) {
        // Tehlikeli karakterleri temizle
        $input = strip_tags($input);
        // SQL enjeksiyon karakterlerini temizle
        $input = str_replace(["'", '"', '\\', ';', '+', 'CONCAT', 'CHR', 'SOCKET', 'REQUIRE', 'GETHOSTBYNAME'], '', $input);
        // Ekstra güvenlik için HTML karakterleri kodla
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }
}
