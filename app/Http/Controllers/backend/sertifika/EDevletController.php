<?php

namespace App\Http\Controllers\backend\sertifika;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\KesinKayitForm;
use App\Models\Siniflar;
use Illuminate\Support\Str;
use setasign\Fpdi\Fpdi;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use setasign\Fpdi\PdfReader;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Courses;

class EDevletController extends Controller
{
    public function toastr($message, $alertType)
    {
        $notification = array(
            'message' => $message,
            'alert-type' => $alertType
        );

        return $notification;
    }

    public function getCertificatesByTcKimlikNo($tc)
    {
        //dd($request);
       // $sinifId = $request->sinif_id;
       // $kursId = $request->kurs_id;
        $classLists = KesinKayitForm::where('tc', $tc)->get();
        $course_data = Courses::where('id', $classLists[0]->kurs_id)->first();
        $classData= Siniflar::where('id', $classLists[0]->sinif_id)->get();
        $data = [];
        $data['sertifika_id']=$classLists[0]->id;

       /* $data['sertifika_no']= date('Y/m', strtotime($classLists[0]->created_at));
        $data['tur']='Sertifika';
        $data['sertifika_adi']=$course_data->egitim_adi;
        $data['yer']=$course_data->egitim_yeri;*/

        return $data;

    }

}
