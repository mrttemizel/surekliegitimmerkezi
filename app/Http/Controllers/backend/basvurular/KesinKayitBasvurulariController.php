<?php

namespace App\Http\Controllers\backend\basvurular;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\KesinKayitForm;
use App\Models\OnBasvuruForm;
use App\Models\Siniflar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KesinKayitBasvurulariController extends Controller
{
    public  function  toastr($message,$alertType)
    {
        $notification = array(
            'message' => $message,
            'alert-type' => $alertType
        );

        return $notification;
    }

    public function index()
    {
        $data = KesinKayitForm::where(function ($query) {
            $query->whereNull('sinif_id')
                ->orWhere('sinif_id', '');
        })->get();

        $courses = Courses::all();
        return view('backend.kesin-kayit.index',compact('data','courses'));
    }

    public function getData(Request $request)
    {
        $data = KesinKayitForm::findOrFail($request->id);
        return response()->json($data);
    }
    public function getSinif(Request $request)
    {
        $data = Siniflar::all();
        return response()->json($data);
    }

    public function delete($id)
    {
        $data = KesinKayitForm::find($id);

        $files = ['diploma', 'kimlik', 'kurumkarti'];

        foreach ($files as $file) {
            $path = public_path() . '/kesin-kayit-evraklari/' . $data->$file;
            if (\File::exists($path)) {
                \File::delete($path);
            }
        }
        $query = $data->delete();
        if (!$query) {
            return back()->with($this->toastr('Başvuru Silerken Hata Oluştu','error'));
        } else {
            return back()->with($this->toastr('Başvuru Silme Başarılı', 'success'));
        }
    }

    public function edit($id)
    {
        $data = KesinKayitForm::find($id);
        $courses = Courses::all();

        return view('backend.kesin-kayit.edit',compact('data','courses'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $data = KesinKayitForm::where('id', $request->id)->first();

        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
        $data->tc = $request->input('tc');
        $data->kurs_id = $request->input('kurs_id');

        $kurs = Courses::where('id',$request->kurs_id)->firstOrFail();
        $data->kurs_adi = $kurs->egitim_adi;



        $timestamp = Carbon::now()->format('YmdHis'); // YılAyGünSaatDakikaSaniye formatında zaman damgası

        if ($request->hasFile('kimlik')) {
            $request->validate([
                'kimlik' => 'required|file|mimes:pdf|max:2048',
            ]);

            $path = public_path('kesin-kayit-evraklari/' . $data->kimlik);

            if (\File::exists($path)) {
                \File::delete($path);
            }

            $file = $request->file('kimlik');
            $kimlikname = Str::slug($request->input('name')).'-' . 'kimlik' .'-' . $timestamp .'.'.$file->getClientOriginalExtension();
            $file->move(public_path('kesin-kayit-evraklari'), $kimlikname);
            $data->kimlik = $kimlikname;
        }

        if ($request->hasFile('diploma')) {
            $request->validate([
                'diploma' => 'required|file|mimes:pdf|max:2048',
            ]);

            $path2 = public_path('kesin-kayit-evraklari/' . $data->diploma);

            if (\File::exists($path2)) {
                \File::delete($path2);
            }
            $file = $request->file('diploma');
            $diplomaname = Str::slug($request->input('name')).'-' . 'diploma' .'-' . $timestamp .'.'.$file->getClientOriginalExtension();
            $file->move(public_path('kesin-kayit-evraklari'), $diplomaname);
            $data->diploma = $diplomaname;
        }

        if ($request->hasFile('kurumkarti')) {
            $request->validate([
                'kurumkarti' => 'required|file|mimes:pdf|max:2048',
            ]);

            $path3 = public_path('kesin-kayit-evraklari/' . $data->kurumkarti);

            if (\File::exists($path3)) {
                \File::delete($path3);
            }
            $file = $request->file('kurumkarti');
            $kurumkartimaname = Str::slug($request->input('name')).'-' . 'kurum-karti' .'-' . $timestamp .'.'.$file->getClientOriginalExtension();
            $file->move(public_path('kesin-kayit-evraklari'), $kurumkartimaname);
            $data->kurumkarti = $kurumkartimaname;
        }


        $query = $data->update();

        if (!$query) {
            return back()->with($this->toastr('Kişi Güncelleme Başarısız','error'));
        } else {
            return back()->with($this->toastr('Kişi Güncelleme Başarılı','success'));
        }
    }

    public function sinifAta(Request $request)
    {
        $data = KesinKayitForm::findOrFail($request->id);
        $data->sinif_id =  $request->sinif_id;

        $query = $data->update();

        if (!$query) {
            return back()->with($this->toastr('Kişi Sınıfa Atanması Başarısız','error'));
        } else {
            return back()->with($this->toastr('Kişi Sınıfa Atanması Başarılı','success'));
        }
    }





}
