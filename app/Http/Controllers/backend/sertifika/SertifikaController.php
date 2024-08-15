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

        $filePath = null; // Initialize $filePath

        foreach ($classLists as $classList) {
            if ($class_data->sertifika == 'tr-eng.pdf') {
                $filePath = $this->createTrPdf($classList, $sinifId, $kursId, $class_data);
            } elseif ($class_data->sertifika == 'katilim.pdf') {
                $filePath = $this->createKatilimPdf($classList, $sinifId, $kursId, $class_data);
            } elseif ($class_data->sertifika == 'temel.pdf') {
                $filePath =$this->createTemelPdf($classList, $sinifId, $kursId, $class_data);
            }

            if ($filePath) {
                $data = KesinKayitForm::where('id', $classList->id)->first();
                $data->sertificate = $filePath;
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
        }
    }
    private function createTrPdf($classList, $sinifId, $kursId , $class_data)
    {
        $pdf = new  Fpdi();

        $pdf->AddFont('arial', '', 'arial.php');
        $pdf->SetFont('arial', '', 22);

        $pagesCount = $pdf->setSourceFile('sertifika_template/'.$class_data->sertifika);

        $qr='UN_0410610'.$classList->tc;
        $qrCode = new QrCode($qr);


        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        $qrCodePath = storage_path('certificates/qrcode.png');
        $result->saveToFile($qrCodePath);

        $pdf->AddPage('O');
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0);

        $pdf->SetTextColor(0, 10, 0);
        $pdf->SetXY(130, 95);
        $pdf->Write(0,iconv('utf-8','windows-1254',$classList->name) );

        $pdf->SetTextColor(0, 10, 0);
        $pdf->SetFontSize(12);
        $pdf->SetXY(47, 135);
        $pdf->Write(0,iconv('utf-8','windows-1254',$class_data->sinif_adi) );

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

        //$pdf->Output($outputDir . '/' . $qr .'_'. $classList->tc . '_certificate.pdf', 'F');
       // $pdf->Output($outputDir . '/' . $classList->tc . '-' .$qr. '/' .'_certificate.pdf', 'F');
        return $outputDir . '/' . $fileName;
    }
    private function createKatilimPdf($classList, $sinifId, $kursId , $class_data)
    {
        $pdf = new  Fpdi();

        $pdf->AddFont('arial', '', 'arial.php');
        $pdf->SetFont('arial', '', 22);

        $pagesCount = $pdf->setSourceFile('sertifika_template/'.$class_data->sertifika);

        $qr='UN_0410610'.$classList->tc;
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
        $pdf->SetXY(139, 100);
        $pdf->Write(0,iconv('utf-8','windows-1254',$classList->name) );

        $pdf->SetFontSize(12);
        $pdf->SetXY(87, 121);
        $pdf->Write(0,iconv('utf-8','windows-1254',$createdTime) );

        $pdf->SetXY(35, 135);
        $pdf->Write(0,iconv('utf-8','windows-1254','48') );

        $pdf->SetXY(67, 135);
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
    private function createTemelPdf($classList, $sinifId, $kursId , $class_data)
{
    $pdf = new  Fpdi();

    $pdf->AddFont('arial', '', 'arial.php');
    $pdf->SetFont('arial', '', 22);

    $pagesCount = $pdf->setSourceFile('sertifika_template/'.$class_data->sertifika);

    $qr='UN_0410610'.$classList->tc;
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
    $pdf->SetXY(130, 105);
    $pdf->Write(0,iconv('utf-8','windows-1254',$classList->name) );

    $pdf->SetFontSize(12);
    $pdf->SetXY(95, 130);
    $pdf->Write(0,iconv('utf-8','windows-1254',$createdTime) );

    $pdf->SetXY(62, 143);
    $pdf->Write(0,iconv('utf-8','windows-1254','48') );

    $pdf->SetXY(90, 143);
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
