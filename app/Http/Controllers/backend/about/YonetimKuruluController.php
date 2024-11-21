<?php

namespace App\Http\Controllers\backend\about;

use App\Http\Controllers\Controller;
use App\Models\YonetimKurulu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class YonetimKuruluController extends Controller
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
        $data = YonetimKurulu::findOrFail($request->id);
        $data->status = $request->status=="true" ? 1 : 0;
        $data->save();
    }

    public function getData(Request $request)
    {
        $data = YonetimKurulu::findOrFail($request->id);
        return response()->json($data);
    }


    public function index()
    {
        $data = YonetimKurulu::orderBy('order', 'asc')->get();
        return view('backend.about.yonetimkurulu',compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'pozisyon' => 'required',
        ]);

        $data = new YonetimKurulu();



        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->title = $request->input('title');
        $data->pozisyon = $request->input('pozisyon');

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,jpeg,png,svg|max:8048',
            ]);

            $file = $request->file('image');
            $imagename = Str::slug($request->input('name')).'.'.time(). '.'.$file->getClientOriginalExtension();
            $file->move(public_path('yonetimkurulu'), $imagename);
            $data->image = $imagename;

        }

        $query = $data->save();
        if (!$query) {
            return back()->with('error', 'Personel Eklenirken bir hata oluştu!');
        } else {
            return back()->with($this->toastr('Personel Ekleme Başarılı','success'));
        }

    }




    public function delete($id)
    {
        $data = YonetimKurulu::find($id);

        $path = public_path() . '/yonetimkurulu/' . $data->image;

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
        foreach ($request->get('yonetimkurulu') as $key => $id) {
            YonetimKurulu::where('id', $id)->update(['order' => $key]);
        }

    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'pozisyon' => 'required',
        ]);
        $data = YonetimKurulu::where('id', $request->id)->first();

        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->title = $request->input('title');
        $data->pozisyon = $request->input('pozisyon');

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,jpeg,png,svg|max:8048',
            ]);

            $path = public_path('yonetimkurulu/' . $data->image);

            if (\File::exists($path)) {
                \File::delete($path);
            }
            $file = $request->file('image');
            $imagename = Str::slug($request->input('name')) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('yonetimkurulu'), $imagename);
            $data->image = $imagename;
        }

        $query = $data->update();

        if (!$query) {
            return back()->with($this->toastr('Kişi Güncelleme Başarısız','error'));
        } else {
            return back()->with($this->toastr('Kişi Güncelleme Başarılı','success'));
        }
    }

}
