<?php

namespace App\Http\Controllers\frontend\about;

use App\Http\Controllers\Controller;
use App\Mail\ContactFormMail;
use App\Models\BankaIs;
use App\Models\Egitmenlerimiz;
use App\Models\Formlar;
use App\Models\OrganizationChart;
use App\Models\Settings;
use App\Models\Yonetim;
use App\Models\YonetimKurulu;
use App\Models\EducationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AboutController extends Controller
{
    public  function yonetim()
    {

        $data = Yonetim::where('status', 1)->orderBy('order')->get();


        return view('frontend.about.yonetim',compact('data'));
    }

    public  function yonetim_kurulu()
    {

        $data = YonetimKurulu::where('status', 1)->orderBy('order')->get();


        return view('frontend.about.yonetim_kurulu',compact('data'));
    }

    public  function egitmenler()
    {

        $data = Egitmenlerimiz::where('status', 1)->orderBy('order')->get();


        return view('frontend.about.egitmenler',compact('data'));
    }

    public  function formlar()
    {

        $data = Formlar::where('status', 1)->orderBy('name')->get();



        return view('frontend.about.formlar',compact('data'));
    }

    public  function banka_hesap()
    {

        $data = BankaIs::find(1);


        return view('frontend.about.banka_hesap',compact('data'));
    }

    public  function is_birligi_yaptigimiz_kurumlar()
    {

        $data = BankaIs::find(1);

        return view('frontend.about.is_birligi_kurumlar',compact('data'));
    }

    public  function is_birligi_yaptigimiz_kurumlara_verilen_egitimler()
    {

        $data = BankaIs::find(1);


        return view('frontend.about.is_birligi_kurumlar_verilen_egitimler',compact('data'));
    }


    public function iletisim()
    {

        $data = Settings::find(1);
        return view('frontend.about.iletisim',compact('data'));
    }

    public  function education_request()
    {

        $data = EducationRequest::find(1);


        return view('frontend.about.education_request',compact('data'));
    }

    public  function organization_chart()
    {

        $data = OrganizationChart::find(1);


        return view('frontend.about.organization_chart',compact('data'));
    }

    public function sendMail(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $data = $request->only(['name', 'email', 'subject', 'phone', 'message']);

        Mail::to('murat.temizel@antalya.edu.tr')->send(new ContactFormMail($data));

        return back()->with('success', 'Mesajınız başarıyla gönderildi.');

    }
}
