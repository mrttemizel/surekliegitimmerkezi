<?php

namespace App\Http\Controllers\backend\about;

use App\Http\Controllers\Controller;
use App\Models\Egitmenlerimiz;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EgitmenlerController extends Controller
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
        $data = Egitmenlerimiz::findOrFail($request->id);
        $data->status = $request->status=="true" ? 1 : 0;
        $data->save();
    }

    public function getData(Request $request)
    {
        $data = Egitmenlerimiz::findOrFail($request->id);
        return response()->json($data);
    }


    public function index()
    {
        $data = Egitmenlerimiz::orderBy('order', 'asc')->get();
        return view('backend.about.egitmenlerimiz',compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'title' => 'required',
        ]);

        $data = new Egitmenlerimiz();



        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->title = $request->input('title');

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,jpeg,png,svg|max:8048',
            ]);

            $file = $request->file('image');
            $imagename = Str::slug($request->input('name')).'.'.time(). '.'.$file->getClientOriginalExtension();
            $file->move(public_path('egitmenlerimiz'), $imagename);
            $data->image = $imagename;

        }

        $query = $data->save();
        if (!$query) {
            return back()->with('error', 'Eğitmen Eklenirken bir hata oluştu!');
        } else {
            return back()->with($this->toastr('Eğitmen Ekleme Başarılı','success'));
        }

    }


    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'title' => 'required',
        ]);
        $data = Egitmenlerimiz::where('id', $request->id)->first();

        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->title = $request->input('title');

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,jpeg,png,svg|max:8048',
            ]);

            $path = public_path('egitmenlerimiz/' . $data->image);

            if (\File::exists($path)) {
                \File::delete($path);
            }
            $file = $request->file('image');
            $imagename = Str::slug($request->input('name')) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('egitmenlerimiz'), $imagename);
            $data->image = $imagename;
        }

        $query = $data->update();

        if (!$query) {
            return back()->with($this->toastr('Kişi Güncelleme Başarısız','error'));
        } else {
            return back()->with($this->toastr('Kişi Güncelleme Başarılı','success'));
        }
    }


    public function delete($id)
    {
        $data = Egitmenlerimiz::find($id);

        $path = public_path() . '/egitmenlerimiz/' . $data->image;

        if (\File::exists($path)) {
            \File::delete($path);
        }
        $query = $data->delete();
        if (!$query) {
            return back()->with($this->toastr('Eğitmen Silerken Hata Oluştu','error'));
        } else {
            return back()->with($this->toastr('Eğitmen Silme Başarılı','success'));
        }
    }

    public function orders(Request $request)
    {
        foreach ($request->get('egitmen') as $key => $id) {
            Egitmenlerimiz::where('id', $id)->update(['order' => $key]);
        }

    }
}
