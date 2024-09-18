<?php

namespace App\Http\Controllers\backend\sertifika;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\KesinKayitForm;
use App\Models\Siniflar;
use App\Models\TemplateSettings;
use Illuminate\Support\Str;
use setasign\Fpdi\Fpdi;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use setasign\Fpdi\PdfReader;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Courses;

class SertifikaController extends Controller
{
    public function toastr($message, $alertType)
    {
        $notification = array(
            'message' => $message,
            'alert-type' => $alertType
        );

        return $notification;
    }

    public function generateCertificates(Request $request)
    {
        $sinifId = $request->sinif_id;
        $kursId = $request->kurs_id;
        $classLists = KesinKayitForm::where('status', 1)
            ->where('kurs_id', $kursId)
            ->where('sinif_id', $sinifId)
            ->get();
        $class_data = Siniflar::where('id', $sinifId)->first();
        $courses_data = Courses::where('id', $kursId)->first();

        $filePath = null; // Initialize $filePath

        foreach ($classLists as $classList) {
            if ($class_data->sertifika == 'tr-eng.pdf') {
                $filePath = $this->createTrPdf($classList, $sinifId, $kursId, $class_data, $courses_data);
            } elseif ($class_data->sertifika == 'katilim.pdf') {
                $filePath = $this->createKatilimPdf($classList, $sinifId, $kursId, $class_data, $courses_data);
            } elseif ($class_data->sertifika == 'temel.pdf') {
                $filePath =$this->createTemelPdf($classList, $sinifId, $kursId, $class_data, $courses_data);
            }

            if ($filePath) {
                $data = KesinKayitForm::where('id', $classList->id)->first();
                $data->sertificate = $filePath;
                $data->status = 2;
                $data->update();
            } else {
                return response()->json(['message' => 'Sertifikaların Oluşturulma Aşamasında Sorun Oluştu']);
            }
        }

        if ($filePath) {
            // $classList->update(['status' => 2]);  ??????

            $data = Siniflar::where('id', $sinifId)->first();
            $data->sinif_durumu = '2';
            $query = $data->update();

            if (!$query) {
                return back()->with($this->toastr('Sertifikanız Oluşturulamadı', 'error'));
            } else {
                return back()->with($this->toastr('Sertifika Oluşturma Başarılı', 'success'));
            }
        }else{
            return back()->with($this->toastr('Sertifikanız Oluşturulamadı', 'error'));
        }
    }
    private function createTrPdf($classList, $sinifId, $kursId, $class_data ,$courses_data)
    {
        $pdf = new Fpdi();
        $pdf->AddFont('arial', '', 'arial.php');
        $pdf->SetFont('arial', '', 22);
        $fullName = $classList->name . ' ' . $classList->surname;
        $nameLength = strlen($fullName);

        $fontSize = 22;

        if ($nameLength > 20) {
            $fontSize = 12;
        } elseif ($nameLength > 15) {
            $fontSize = 16;
        } elseif ($nameLength > 11) {
            $fontSize = 18;
        }

        $pdf->SetFontSize($fontSize);
        $pagesCount = $pdf->setSourceFile('sertifika_template/' . $class_data->sertifika);
        $trfullnameCoord = TemplateSettings::where('certificate_value', 'trfullname')
            ->first()->certificate_coord;

        $trclassnameengCoord = TemplateSettings::where('certificate_value', 'trclassnameeng')
            ->first()->certificate_coord;

        $trcreatedtimeCoord = TemplateSettings::where('certificate_value', 'trcreatedtime')
            ->first()->certificate_coord;

        $trclassnameCoord = TemplateSettings::where('certificate_value', 'trclassname')
            ->first()->certificate_coord;

        $qr = 'UN_041061' . $classList->tc . $sinifId;
        $qr = substr($qr, 0, 22);
        $qrCode = new QrCode($qr);

        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        $qrCodePath = storage_path('certificates/qrcode.png');
        $result->saveToFile($qrCodePath);

        $pdf->AddPage('O');
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0);

        $pdf->SetTextColor(0, 10, 0);
        list($x, $y) = explode(',', $trfullnameCoord);
        $pdf->SetXY($x, $y);

        // İsim ve soyismi yazdır
        $pdf->Write(0, iconv('utf-8', 'windows-1254', $fullName));

        $trclaslenght = strlen($courses_data->egitim_adi);
        if ($trclaslenght > 20) {
            $fontSize = 12;
        } elseif ($trclaslenght > 15) {
            $fontSize = 16;
        } elseif ($trclaslenght > 11) {
            $fontSize = 18;
        }

        $pdf->SetTextColor(0, 10, 0);
        $pdf->SetFontSize( $fontSize);
        list($x, $y) = explode(',', $trclassnameCoord);
        $pdf->SetXY($x, $y);
        $pdf->Write(0,iconv('utf-8','windows-1254',$courses_data->egitim_adi) );

        $engclaslenght = strlen($courses_data->egitim_adi_ing);
        if ($engclaslenght > 20) {
            $fontSize = 12;
        } elseif ($engclaslenght > 15) {
            $fontSize = 16;
        } elseif ($engclaslenght > 11) {
            $fontSize = 18;
        }

        $pdf->SetTextColor(0, 10, 0);
        $pdf->SetFontSize($fontSize);
        list($x, $y) = explode(',', $trclassnameengCoord);
        $pdf->SetXY($x, $y);
        $pdf->Write(0,iconv('utf-8','windows-1254',$courses_data->egitim_adi_ing) );

        $pdf->Image($qrCodePath, 250, 165, 25, 25);
        $pdf->AddPage('O');
        $tplIdx = $pdf->importPage(2);
        $pdf->useTemplate($tplIdx, 0, 0);

        $pdf->SetTextColor(0, 0, 255);
        $pdf->SetXY(245, 163);
        $createdTime = date('Y/m/d', strtotime($classList->created_at));
        $pdf->Write(0, $createdTime);

        $pdf->SetXY(245, 173);
        $createdYearMonth = date('Y/m', strtotime($classList->created_at));
        $pdf->Write(0, $createdYearMonth);

        $outputDir = 'sertifikalar/' . $kursId . '/' . $sinifId;
        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0777, true);
        }
        $fileName = $qr . '_' . $classList->tc . '_certificate.pdf';
        $pdf->Output($outputDir . '/' . $fileName, 'F');

        return $outputDir . '/' . $fileName;
    }
    private function createKatilimPdf($classList, $sinifId, $kursId , $class_data ,$courses_data)
    {
        $pdf = new  Fpdi();

        $pdf->AddFont('arial', '', 'arial.php');
        $pdf->SetFont('arial', '', 22);
        $fullName = $classList->name . ' ' . $classList->surname;
        $nameLength = strlen($fullName);

        $fontSize = 22;

        if ($nameLength > 20) {
            $fontSize = 12;
        } elseif ($nameLength > 15) {
            $fontSize = 16;
        } elseif ($nameLength > 11) {
            $fontSize = 18;
        }

        $pdf->SetFontSize($fontSize);
        $kfullnameCoord = TemplateSettings::where('certificate_value', 'kfullname')
            ->first()->certificate_coord;

        $keducationtimeCoord = TemplateSettings::where('certificate_value', 'keducationtime')
            ->first()->certificate_coord;

        $kcreatedtimeCoord = TemplateSettings::where('certificate_value', 'kcreatedtime')
            ->first()->certificate_coord;

        $kclassnameCoord = TemplateSettings::where('certificate_value', 'kclassname')
            ->first()->certificate_coord;

        $pagesCount = $pdf->setSourceFile('sertifika_template/'.$class_data->sertifika);

        $qr = 'UN_041061' . $classList->tc . $sinifId;
        $qr = substr($qr, 0, 22);
        $createdTime = date('Y/m/d', strtotime($classList->created_at));
        $qrCode = new QrCode($qr);


        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        $qrCodePath = storage_path('certificates/qrcode.png');
        $result->saveToFile($qrCodePath);

        $pdf->AddPage('O');
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0);
        list($x, $y) = explode(',', $kfullnameCoord);
        $pdf->SetTextColor(0, 10, 0);
        $pdf->SetXY($x, $y);
        $pdf->Write(0,iconv('utf-8','windows-1254', $fullName) );

        list($x, $y) = explode(',', $kcreatedtimeCoord);
        $pdf->SetFontSize(12);
        $pdf->SetXY($x, $y);
        $pdf->Write(0,iconv('utf-8','windows-1254',$createdTime) );

        list($x, $y) = explode(',', $keducationtimeCoord);
        $pdf->SetXY($x, $y);
        $pdf->Write(0,iconv('utf-8','windows-1254',$courses_data->egitim_saati) );

        list($x, $y) = explode(',', $kclassnameCoord);
        $pdf->SetXY($x, $y);
        $pdf->Write(0,iconv('utf-8','windows-1254',$class_data->sinif_adi) );

        $pdf->Image($qrCodePath, 250, 165, 25, 25);
        $pdf->AddPage('O');
        $tplIdx = $pdf->importPage(2);
        $pdf->useTemplate($tplIdx, 0, 0);

        $pdf->SetTextColor(0, 0, 255);
        $pdf->SetXY(256, 160);
        $pdf->Write(0, $createdTime);

        $pdf->SetXY(256, 166);
        $createdYearMonth = date('Y/m', strtotime($classList->created_at));
        $pdf->Write(0, $createdYearMonth);

        $pdf->SetXY(256, 173);
        $pdf->Write(0,$classList->tc);

        $outputDir = 'sertifikalar/' . $kursId . '/' . $sinifId;
        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0777, true);
        }
       // $pdf->Output($outputDir . '/' . $qr .'_'. $classList->tc . '_certificate.pdf', 'F');
        //return true;
        $fileName = $qr . '_' . $classList->tc . '_certificate.pdf';
        $pdf->Output($outputDir . '/' . $fileName, 'F');
        return $outputDir . '/' . $fileName;
    }
    private function createTemelPdf($classList, $sinifId, $kursId , $class_data ,$courses_data)
{
    $pdf = new  Fpdi();

    $pdf->AddFont('arial', '', 'arial.php');
    $pdf->SetFont('arial', '', 22);
    $fullName = $classList->name . ' ' . $classList->surname;
    $nameLength = strlen($fullName);

    $fontSize = 22;

    if ($nameLength > 20) {
        $fontSize = 12;
    } elseif ($nameLength > 15) {
        $fontSize = 16;
    } elseif ($nameLength > 11) {
        $fontSize = 18;
    }

    $pdf->SetFontSize($fontSize);
    $tfullnameCoord = TemplateSettings::where('certificate_value', 'tfullname')
        ->first()->certificate_coord;

    $teducationtimeCoord = TemplateSettings::where('certificate_value', 'teducationtime')
        ->first()->certificate_coord;

    $tcreatedtimeCoord = TemplateSettings::where('certificate_value', 'tcreatedtime')
        ->first()->certificate_coord;

    $tclassnameCoord = TemplateSettings::where('certificate_value', 'tclassname')
        ->first()->certificate_coord;

    $pagesCount = $pdf->setSourceFile('sertifika_template/'.$class_data->sertifika);

    $qr = 'UN_041061' . $classList->tc . $sinifId;
    $qr = substr($qr, 0, 22);
    $createdTime = date('Y/m/d', strtotime($classList->created_at));
    $qrCode = new QrCode($qr);


    $writer = new PngWriter();
    $result = $writer->write($qrCode);
    $qrCodePath = storage_path('certificates/qrcode.png');
    $result->saveToFile($qrCodePath);

    $pdf->AddPage('O');
    $tplIdx = $pdf->importPage(1);
    $pdf->useTemplate($tplIdx, 0, 0);

    $pdf->SetTextColor(0, 10, 0);
    list($x, $y) = explode(',', $tfullnameCoord);
    $pdf->SetXY($x, $y);
    $pdf->Write(0,iconv('utf-8','windows-1254', $fullName) );

    $pdf->SetFontSize(12);
    list($x, $y) = explode(',', $tcreatedtimeCoord);
    $pdf->SetXY($x, $y);
    $pdf->Write(0,iconv('utf-8','windows-1254',$createdTime) );

    list($x, $y) = explode(',', $teducationtimeCoord);
    $pdf->SetXY($x, $y);
    $pdf->Write(0,iconv('utf-8','windows-1254',$courses_data->egitim_saati) );

    list($x, $y) = explode(',', $tclassnameCoord);
    $pdf->SetXY($x, $y);
    $pdf->Write(0,iconv('utf-8','windows-1254',$class_data->sinif_adi) );

    $pdf->Image($qrCodePath, 250, 165, 25, 25);
    $pdf->AddPage('O');
    $tplIdx = $pdf->importPage(2);
    $pdf->useTemplate($tplIdx, 0, 0);

    $pdf->SetTextColor(0, 0, 255);
    $pdf->SetXY(256, 166);
    $pdf->Write(0, $createdTime);

    $pdf->SetXY(256, 173);
    $createdYearMonth = date('Y/m', strtotime($classList->created_at));
    $pdf->Write(0, $createdYearMonth);

    $pdf->SetXY(256, 180);
    $pdf->Write(0,$classList->tc);

    $outputDir = 'sertifikalar/' . $kursId . '/' . $sinifId;
    if (!file_exists($outputDir)) {
        mkdir($outputDir, 0777, true);
    }
    //$pdf->Output($outputDir . '/' . $qr .'_'. $classList->tc . '_certificate.pdf', 'F');
   // return true;

    $fileName = $qr . '_' . $classList->tc . '_certificate.pdf';
    $pdf->Output($outputDir . '/' . $fileName, 'F');
    return $outputDir . '/' . $fileName;
}

}
