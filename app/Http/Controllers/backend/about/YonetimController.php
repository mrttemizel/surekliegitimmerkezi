<?php

namespace App\Http\Controllers\backend\about;

use App\Http\Controllers\Controller;
use App\Models\Yonetim;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class YonetimController extends Controller
{
    public  function  toastr($message,$alertType)
    {
        $notification = array(
            'message' => $message,
            'alert-type' => $alertType
        );

        return $notification;
    }

    public function switch(Request $request)
    {
        $data = Yonetim::findOrFail($request->id);
        $data->status = $request->status=="true" ? 1 : 0;
        $data->save();
    }

    public function getData(Request $request)
    {
        $data = Yonetim::findOrFail($request->id);
        return response()->json($data);
    }


    public function index()
    {
        $data = Yonetim::orderBy('order', 'asc')->get();
        return view('backend.about.yonetim',compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'title' => 'required',
        ]);

        $data = new Yonetim();



        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->title = $request->input('title');

        if ($request->hasFile('image')) {
           /* $request->validate([
                'image' => 'image|mimes:jpg,jpeg,png,svg|max:8048',
            ]); */

            $file = $request->file('image');
            $imagename = Str::slug($request->input('name')).'.'.time(). '.'.$file->getClientOriginalExtension();
            $file->move(public_path('yonetim'), $imagename);
            $data->image = $imagename;

        }

        $query = $data->save();
        if (!$query) {
            return back()->with('error', 'Personel Eklenirken bir hata oluştu!');
        } else {
            return back()->with($this->toastr('Personel Ekleme Başarılı','success'));
        }

    }


    public function update(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required',
            'title' => 'required',
        ]);

        $data = Yonetim::findOrFail($request->id);

        $data->name  = $request->input('name');
        $data->email = $request->input('email');
        $data->title = $request->input('title');

        // 1) Eğer "Mevcut resmi sil" checkbox'ı işaretlendiyse
        if ($request->has('delete_image') && $data->image) {
            $path = public_path('yonetim/' . $data->image);
            if (\File::exists($path)) {
                \File::delete($path);
            }
            $data->image = null;
        }

        // 2) Yeni resim yüklendiyse
        if ($request->hasFile('image')) {
            /*
            // İsteğe bağlı validation (mime / boyut)
            $request->validate([
                'image' => 'image|mimes:jpg,jpeg,png,svg|max:8048'
            ]);
            */

            // Eski resim varsa sil
            if ($data->image) {
                $oldPath = public_path('yonetim/' . $data->image);
                if (\File::exists($oldPath)) {
                    \File::delete($oldPath);
                }
            }

            // Yeni resmi kaydet
            $file = $request->file('image');
            $imagename = Str::slug($request->input('name')) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('yonetim'), $imagename);
            $data->image = $imagename;
        }

        // Değişiklikleri kaydet
        $query = $data->update();

        // Kullanıcıya sonuç dön
        if (!$query) {
            return back()->with($this->toastr('Kişi Güncelleme Başarısız','error'));
        } else {
            return back()->with($this->toastr('Kişi Güncelleme Başarılı','success'));
        }
    }


    public function delete($id)
    {
        $data = Yonetim::find($id);

        $path = public_path() . '/yonetim/' . $data->image;

        if (\File::exists($path)) {
            \File::delete($path);
        }
        $query = $data->delete();
        if (!$query) {
            return back()->with($this->toastr('Kişi Silerken Hata Oluştu','error'));
        } else {
            return back()->with($this->toastr('Kişi Silme Başarılı','success'));
        }
    }

    public function orders(Request $request)
    {
        foreach ($request->get('yonetim') as $key => $id) {
            Yonetim::where('id', $id)->update(['order' => $key]);
        }

    }
}
