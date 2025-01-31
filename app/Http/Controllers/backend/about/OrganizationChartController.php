<?php

namespace App\Http\Controllers\backend\about;

use App\Http\Controllers\Controller;
use App\Models\OrganizationChart;
use Illuminate\Http\Request;

class OrganizationChartController extends Controller
{
    public  function  toastr($message,$alertType)
    {
        $notification = array(
            'message' => $message,
            'alert-type' => $alertType
        );

        return $notification;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = OrganizationChart::find(1);
        return view('backend.about.organizationchart', compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OrganizationChart $organizationChart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrganizationChart $organizationChart)
    {
        //
    }
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/editor-images', $filename, 'public');

            // Geri dönen URL
            $url = asset('storage/' . $filePath);

            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        }

        return response()->json([
            'uploaded' => false,
            'error' => [
                'message' => 'Resim yüklenemedi!'
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Belirli bir ID ile veritabanında kayıt arama
        $data = OrganizationChart::find(1);

        if ($data) {
            // Mevcut kayıt güncelleniyor
            $data->pagecontent = $request->pagecontent ?? 'Değer girişmemiş';

            $query = $data->update();

            if (!$query) {
                return back()->with('error', 'Düzenleme Hatalı!');
            } else {
                return back()->with($this->toastr('Düzenleme Başarılı', 'success'));
            }
        } else {
            // Yeni kayıt oluşturuluyor
            $data = new OrganizationChart();
            $data->pagecontent = $request->pagecontent ?? 'Değer girişmemiş';

            $query = $data->save();

            if (!$query) {
                return back()->with('error', 'Düzenleme Hatalı!');
            } else {
                return back()->with($this->toastr('Düzenleme Başarılı', 'success'));
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrganizationChart $organizationChart)
    {
        //
    }
}
