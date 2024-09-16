<?php

namespace App\Http\Controllers;

use App\Models\TemplateSettings;
use Illuminate\Http\Request;

class TemplateSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function update(Request $request)
    {
        // Validasyon
        $request->validate([
            'kfullname' => 'required|string',
            'keducationtime' => 'required|string',
            'kcreatedtime' => 'required|string',
            'kclassname' => 'required|string',
        ]);

        TemplateSettings::where('certificate_value', 'kfullname')
            ->update(['certificate_coord' => $request->kfullname]);

        TemplateSettings::where('certificate_value', 'keducationtime')
            ->update(['certificate_coord' => $request->keducationtime]);

        TemplateSettings::where('certificate_value', 'kcreatedtime')
            ->update(['certificate_coord' => $request->kcreatedtime]);

        TemplateSettings::where('certificate_value', 'kclassname')
            ->update(['certificate_coord' => $request->kclassname]);

        return redirect()->back()->with('success', 'Sertifikalar başarıyla güncellendi.');
    }

    public function updatecus(Request $request)
    {
        // Validasyon
        $request->validate([
            'tfullname' => 'required|string',
            'teducationtime' => 'required|string',
            'tcreatedtime' => 'required|string',
            'tclassname' => 'required|string',
        ]);

        TemplateSettings::where('certificate_value', 'tfullname')
            ->update(['certificate_coord' => $request->tfullname]);

        TemplateSettings::where('certificate_value', 'teducationtime')
            ->update(['certificate_coord' => $request->teducationtime]);

        TemplateSettings::where('certificate_value', 'tcreatedtime')
            ->update(['certificate_coord' => $request->tcreatedtime]);

        TemplateSettings::where('certificate_value', 'tclassname')
            ->update(['certificate_coord' => $request->tclassname]);

        return redirect()->back()->with('success', 'Sertifikalar başarıyla güncellendi.');
    }

    public function updatetr(Request $request)
    {

        TemplateSettings::where('certificate_value', 'trfullname')
            ->update(['certificate_coord' => $request->trfullname]);

        TemplateSettings::where('certificate_value', 'trclassnameeng')
            ->update(['certificate_coord' => $request->trclassnameeng]);

        TemplateSettings::where('certificate_value', 'trclassname')
            ->update(['certificate_coord' => $request->trclassname]);

        return redirect()->back()->with('success', 'Sertifikalar başarıyla güncellendi.');
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
    public function show(TemplateSettings $templateSettings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TemplateSettings $templateSettings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TemplateSettings $templateSettings)
    {
        //
    }
}
