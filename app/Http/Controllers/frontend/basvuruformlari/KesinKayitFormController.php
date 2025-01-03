<?php

namespace App\Http\Controllers\frontend\basvuruformlari;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\KesinKayitForm;
use App\Models\Siniflar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            return back()->with('success', 'Ön Başvurunuz Başarılı Bir Şekilde Alınmıştır.');
        }

    }
}
