<?php

namespace App\Http\Controllers\backend\about;

use App\Http\Controllers\Controller;
use App\Models\Formlar;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormlarController extends Controller
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
        $data = Formlar::orderBy('name', 'asc')->get();
        return view('backend.about.formlar',compact('data'));
    }

    public function switch(Request $request)
    {
        $data = Formlar::findOrFail($request->id);
        $data->status = $request->status=="true" ? 1 : 0;
        $data->save();
    }

    public function getData(Request $request)
    {
        $data = Formlar::findOrFail($request->id);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = Formlar::where('id', $request->id)->first();
        $data->name = $request->input('name');


        if ($request->hasFile('file')) {

            $request->validate([
                'file' => 'required|file|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx,txt|max:2048',
            ]);
            $path = public_path('formlar/' . $data->image);

            if (\File::exists($path)) {
                \File::delete($path);
            }
            $file = $request->file('file');
            $filename = Str::slug($request->input('name')).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('formlar'), $filename);
            $data->file = $filename;

        }

        $query = $data->update();

        if (!$query) {
            return back()->with($this->toastr('Form Güncelleme Başarısız','error'));
        } else {
            return back()->with($this->toastr('Form Güncelleme Başarılı','success'));
        }
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'file' => 'required|file|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx,txt|max:2048',
        ]);

        $data = new Formlar;
        $data->name = $request->input('name');

        $file = $request->file('file');
        $filename = Str::slug($request->input('name')).'.'.$file->getClientOriginalExtension();
        $file->move(public_path('formlar'), $filename);
        $data->file = $filename;

        $query = $data->save();
        if (!$query) {
            return back()->with('error', 'Form Eklenirken bir hata oluştu!');
        } else {
            return back()->with($this->toastr('Form Ekleme Başarılı','success'));
        }
    }


    public function delete($id)
    {
        $data = Formlar::find($id);

        $path = public_path() . '/formlar/' . $data->file;

        if (\File::exists($path)) {
            \File::delete($path);
        }
        $query = $data->delete();
        if (!$query) {
            return back()->with($this->toastr('Form Silerken Hata Oluştu','error'));
        } else {
            return back()->with($this->toastr('Form Silme Başarılı','success'));
        }
    }
}
