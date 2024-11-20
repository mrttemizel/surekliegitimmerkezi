<?php

namespace App\Http\Controllers\backend\about;

use App\Http\Controllers\Controller;
use App\Models\EducationRequest;
use Illuminate\Http\Request;

class EducationRequestController extends Controller
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
        $data = EducationRequest::find(1);
        return view('backend.about.educationrequest', compact('data'));
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
    public function show(EducationRequest $educationRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EducationRequest $educationRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Belirli bir ID ile veritabanında kayıt arama
        $data = EducationRequest::find(1);

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
            $data = new EducationRequest();
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
    public function destroy(EducationRequest $educationRequest)
    {
        //
    }
}
