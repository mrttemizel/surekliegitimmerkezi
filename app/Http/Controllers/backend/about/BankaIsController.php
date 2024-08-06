<?php

namespace App\Http\Controllers\backend\about;

use App\Http\Controllers\Controller;
use App\Models\BankaIs;
use Illuminate\Http\Request;

class BankaIsController extends Controller
{

    public  function  toastr($message,$alertType)
    {
        $notification = array(
            'message' => $message,
            'alert-type' => $alertType
        );

        return $notification;
    }

    public  function index()
    {
        $data = BankaIs::find(1);
        return view('backend.about.bankais', compact('data'));
    }

    public function update(Request $request)
    {
        // Belirli bir ID ile veritabanında kayıt arama
        $data = BankaIs::find(1);

        if ($data) {
            // Mevcut kayıt güncelleniyor
            $data->banka = $request->banka ?? 'Değer girişmemiş';
            $data->isbirligi = $request->isbirligi ?? 'Değer girişmemiş';
            $data->kurumlar = $request->kurumlar ?? 'Değer girişmemiş';

            $query = $data->update();

            if (!$query) {
                return back()->with('error', 'Düzenleme Hatalı!');
            } else {
                return back()->with($this->toastr('Düzenleme Başarılı', 'success'));
            }
        } else {
            // Yeni kayıt oluşturuluyor
            $data = new BankaIs();
            $data->banka = $request->banka ?? 'Değer girişmemiş';
            $data->isbirligi = $request->isbirligi ?? 'Değer girişmemiş';
            $data->kurumlar = $request->kurumlar ?? 'Değer girişmemiş';

            $query = $data->save();

            if (!$query) {
                return back()->with('error', 'Düzenleme Hatalı!');
            } else {
                return back()->with($this->toastr('Düzenleme Başarılı', 'success'));
            }
        }
    }


}
