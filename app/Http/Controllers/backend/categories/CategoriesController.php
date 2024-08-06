<?php

namespace App\Http\Controllers\backend\categories;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
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
        $data = Categories::all();
        return view('backend.categories.index',compact('data'));
    }

    public function switch(Request $request)
    {
        $data = Categories::findOrFail($request->id);
        $data->status = $request->status=="true" ? 1 : 0;
        $data->save();
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
        ]);

        $isExist = Categories::where('slug', Str::slug($request->name))->first();
        if($isExist)
        {
            return back()->with($this->toastr('Kategori Adı Mevcut','error'));
        }

        $data = new Categories();
        $data->name = $request->input('name');
        $data->slug = Str::slug($request->input('name'));

        $query = $data->save();
        if (!$query) {
            return back()->with('error', 'Kategori Eklenirken bir hata oluştu!');
        } else {
            return back()->with($this->toastr('Kategori Ekleme Başarılı','success'));
        }
    }

    public function getData(Request $request)
    {
        $data = Categories::findOrFail($request->id);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $isExist = Categories::where('slug', Str::slug($request->name))->first();
        if($isExist)
        {
            return back()->with($this->toastr('Kategori Adı Mevcut','error'));
        }

        $data = Categories::where('id', $request->id)->first();

        $data->name = $request->input('name');
        $data->slug = Str::slug($request->input('name'));

        $query = $data->update();

        if (!$query) {
            return back()->with($this->toastr('Kategori Güncelleme Başarısız','error'));
        } else {
            return back()->with($this->toastr('Kategori Güncelleme Başarılı','success'));
        }
    }


    public function delete($id)
    {
        $data = Categories::find($id);


        $count = $data->courseCount();
        if ($count>0)
        {
            Courses::where('category_id', $data->id)->delete();
        }

        $query = $data->delete();
        if (!$query) {
            return back()->with($this->toastr('Kategori Silerken Hata Oluştu','error'));
        } else {
            return back()->with($this->toastr('Kategori Silme Başarılı','success'));
        }
    }

}
