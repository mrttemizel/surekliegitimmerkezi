<?php

namespace App\Http\Controllers\backend\basvurular;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\OnBasvuruForm;
use Illuminate\Http\Request;

class OnKayitBasvurulariController extends Controller
{

    public  function  toastr($message,$alertType)
    {
        $notification = array(
            'message' => $message,
            'alert-type' => $alertType
        );

        return $notification;
    }

    public function index(Request $request)
    {
        $courseId = $request->get('course_id');

        if ($courseId) {
            $data = OnBasvuruForm::where('kurs_id', $courseId)->get();
        } else {
            $data = OnBasvuruForm::all();
        }

        $courses = Courses::all();
        return view('backend.on-kayit.index', compact('data', 'courses'));
    }


    public function delete($id)
    {
        $data = OnBasvuruForm::find($id);

        $query = $data->delete();
        if (!$query) {
            return back()->with($this->toastr('Ön Başvuru Silme İşlemi Hatalı','error'));
        } else {
            return back()->with($this->toastr('Ön Başvuru Silme İşlemi Başarılı','success'));
        }
    }
}
