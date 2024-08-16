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
        ]);

        $kurs = Courses::where('id',$request->id)->firstOrFail();

        $data = new OnBasvuruForm();

        $data->name = $request->input('name');
        $data->surname = $request->input('surname');
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
        $data->kvkk = $request->input('kvkk') === 'on' ? 'on' : 'off';
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
