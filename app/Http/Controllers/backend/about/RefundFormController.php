<?php

namespace App\Http\Controllers\backend\about;

use App\Http\Controllers\Controller;
use App\Models\Refundform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class RefundformController extends Controller
{
    public function index()
    {
        $data = Refundform::orderBy('id', 'DESC')->get();
        return view('backend.about.refundform', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:2048'
        ]);

        $data = new Refundform();
        $data->name = $request->name;
        
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('formlar'), $filename);
            $data->file = $filename;
        }

        $data->save();
        return redirect()->back()->with('success', 'Form başarıyla eklendi.');
    }

    public function getData(Request $request)
    {
        $data = Refundform::find($request->id);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'file' => 'nullable|mimes:pdf,doc,docx|max:2048'
        ]);

        $data = Refundform::find($request->id);
        if (!$data) {
            return redirect()->back()->with('error', 'Form bulunamadı.');
        }

        $data->name = $request->name;

        if ($request->hasFile('file')) {
            // Eski dosyayı sil
            if ($data->file && File::exists(public_path('formlar/' . $data->file))) {
                File::delete(public_path('formlar/' . $data->file));
            }

            // Yeni dosyayı yükle
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('formlar'), $filename);
            $data->file = $filename;
        }

        $data->save();
        return redirect()->back()->with('success', 'Form başarıyla güncellendi.');
    }

    public function delete($id)
    {
        $form = Refundform::find($id);
        if (!$form) {
            return redirect()->back()->with('error', 'Form bulunamadı.');
        }

        // Dosyayı fiziksel olarak sil
        if ($form->file && file_exists(public_path('formlar/' . $form->file))) {
            unlink(public_path('formlar/' . $form->file));
        }

        $form->delete();
        return redirect()->back()->with('success', 'Form başarıyla silindi.');
    }

    public function switch(Request $request)
    {
        $data = Refundform::find($request->id);
        $data->status = $request->status == "true" ? 1 : 0;
        $data->save();
    }
}
