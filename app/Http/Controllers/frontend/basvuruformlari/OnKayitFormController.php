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
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'kvkk' => 'required',
            'explicit' => 'required',
        ]);

        $kurs = Courses::where('id',$request->id)->firstOrFail();

        $data = new OnBasvuruForm();

        $data->name = mb_strtoupper($request->input('name'), 'UTF-8');
        $data->surname = mb_strtoupper($request->input('surname'), 'UTF-8');
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
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



}
