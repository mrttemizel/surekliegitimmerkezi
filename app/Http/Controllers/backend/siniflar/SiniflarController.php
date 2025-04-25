<?php

namespace App\Http\Controllers\backend\siniflar;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\KesinKayitForm;
use App\Models\Siniflar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SiniflarController extends Controller
{
    public function toastr($message, $alertType)
    {
        $notification = array(
            'message' => $message,
            'alert-type' => $alertType
        );

        return $notification;
    }

    public function index()
    {
        $data = Siniflar::all();

        return view('backend.class.index', compact('data'));
    }

    public function create()
    {
        $data = Courses::all();
        return view('backend.class.create', compact('data'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'sinif_adi' => 'required',
            'baslangic_tarihi' => 'required|date',
            'bitis_tarihi' => 'required|date|after_or_equal:baslangic_tarihi',
            'egitim_id' => 'required',
            'sertifika_tipi' => 'required',
            'sertifika' => 'required',
            'sertifika_dili' => 'required',

        ]);
        $isExist = Siniflar::where('slug', Str::slug($request->sinif_adi))->first();
        if($isExist)
        {
            return back()->with($this->toastr('Sınıf Adı Mevcut','error'));
        }
        $data = new Siniflar();

        $data->sinif_adi = $request->input('sinif_adi');
        $data->baslangic_tarihi = $request->input('baslangic_tarihi');
        $data->bitis_tarihi = $request->input('bitis_tarihi');
        $data->egitim_id = $request->input('egitim_id');
        $data->egitici_adi = $request->input('egitici_adi');
        $data->sertifika_tipi = $request->input('sertifika_tipi');
        $data->sertifika_dili = $request->input('sertifika_dili');
        $data->sertifika= $request->input('sertifika');
        $data->slug = Str::slug($request->input('sinif_adi'));

            $query = $data->save();

            if (!$query) {
                return back()->with($this->toastr('Sınıf Ekleme Hatalı', 'error'));
            } else {
                return back()->with($this->toastr('Sınıf Ekleme Başarılı', 'success'));
            }
    }

    public function delete($id)
    {
        $data = Siniflar::find($id);

        $path = public_path() . '/sertifika_template/' . $data->sertifika;

        if (\File::exists($path)) {
            \File::delete($path);
        }
        $query = $data->delete();
        if (!$query) {
            return back()->with($this->toastr('Sınıf Silerken Hata Oluştu', 'error'));
        } else {
            return back()->with($this->toastr('Sınıf Silme Başarılı', 'success'));
        }
    }

    public function edit($id)
    {
        $data = Siniflar::where('id', $id)->first();
        $courses = Courses::all();
        return view('backend.class.edit', compact('data', 'courses'));
    }

    public function makeactive($id)
    {
        $data = Siniflar::where('id', $id)->first();
        if ($data) {
            $data->sinif_durumu = 1;
            $data->save();
        }

        KesinKayitForm::where('sinif_id', $id)
            ->update([
                'status' => 1,
                'sertificate' => null,
            ]);
        $data = Siniflar::all();

        return view('backend.class.index', compact('data'));
    }

    public function update(Request $request)
    {


        $request->validate([
            'sinif_adi' => 'required',
            'baslangic_tarihi' => 'required|date',
            'bitis_tarihi' => 'required|date|after_or_equal:baslangic_tarihi',
            'egitim_id' => 'required',
            'sertifika_tipi' => 'required',
            'sertifika_dili' => 'required',

        ]);

       /* $isExist = Siniflar::where('slug', Str::slug($request->sinif_adi))->first();
        if($isExist)
        {
            return back()->with($this->toastr('Sınıf Adı Mevcut','error'));
        } */
        $data = Siniflar::where('id', $request->id)->first();
        $data->slug = Str::slug($request->input('sinif_adi'));

        $data->sinif_adi = $request->input('sinif_adi');
        $data->baslangic_tarihi = $request->input('baslangic_tarihi');
        $data->bitis_tarihi = $request->input('bitis_tarihi');
        $data->egitici_adi = $request->input('egitici_adi');
        $data->sertifika_tipi = $request->input('sertifika_tipi');
        $data->sertifika_dili = $request->input('sertifika_dili');


        if ($request->hasFile('sertifika')) {
            $request->validate([
                'sertifika' => 'file|mimes:pdf|max:2048',
            ]);
            $path = public_path() . '/sertifika_template/' . $data->sertifika;

            if (\File::exists($path)) ;
            {
                \File::delete($path);
            }
            $timestamp = Carbon::now()->format('YmdHis'); // YılAyGünSaatDakikaSaniye formatında zaman damgası


            $file = $request->file('sertifika');
            $sertifikakname = Str::slug($request->input('sinif_adi')) . '-' . 'sertifika' . '-' . $timestamp . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('sertifika_template'), $sertifikakname);
            $data->sertifika = $sertifikakname;


        }

        $query = $data->update();

        if (!$query) {
            return back()->with($this->toastr('Sınıf Güncelleme Hatalı','error'));
        } else {
            return back()->with($this->toastr('Sınıf Güncelleme Başarılı','success'));
        }
    }

    public function list()
    {
        $data = Siniflar::where('status', 1)->where('sinif_durumu', 1)->get();
        $classLists = collect(); // Boş bir koleksiyon
        return view('backend.class.list', compact('classLists', 'data'));
    }

    public function oldList()
    {
        $data = Siniflar::where('status', 1)->where('sinif_durumu', 2)->get();
        $classLists = collect(); // Boş bir koleksiyon
        return view('backend.class.old-list', compact('classLists', 'data'));
    }



    public function filter(Request $request)
    {
        $selectedClassId = $request->input('sinif_select');
        $data = Siniflar::where('status', 1)->where('sinif_durumu', 1)->get();

        if ($selectedClassId) {
            $classLists = KesinKayitForm::where('sinif_id', $selectedClassId)->get();
        } else {
            $classLists = collect(); // Boş bir koleksiyon
        }

        return view('backend.class.list', compact('classLists', 'data'));
    }

    public function filterold(Request $request)
    {
        $selectedClassId = $request->input('sinif_select');
        $data = Siniflar::where('status', 1)->where('sinif_durumu', 2)->get();

        if ($selectedClassId) {
            $classLists = KesinKayitForm::where('sinif_id', $selectedClassId)->get();
        } else {
            $classLists = collect(); // Boş bir koleksiyon
        }

        return view('backend.class.old-list', compact('classLists', 'data'));
    }


    public function switch(Request $request)
    {
        $data = KesinKayitForm::findOrFail($request->id);
        $data->status = $request->status;
        $data->save();
        
        // Sayfaya geri dön
        return redirect()->route('class.filter', [
            'sinif_select' => $request->sinif_select,
            'page' => $request->page
        ]);
    }

    public function allList(Request $request)
    {
        $query = KesinKayitForm::query();

        // Apply filters
        if ($request->has('tc') && !empty($request->tc)) {
            $query->where('tc', 'like', '%' . $request->tc . '%');
        }
        if ($request->has('name') && !empty($request->name)) {
            $query->whereRaw("CONCAT(name, ' ', surname) LIKE ?", ['%' . $request->name . '%']);
        }
        if ($request->has('egitim') && !empty($request->egitim)) {
            $query->where('kurs_adi', $request->egitim);
        }
        if ($request->has('sinif') && !empty($request->sinif)) {
            $query->whereHas('getSinif', function ($q) use ($request) {
                $q->where('sinif_adi', $request->sinif);
            });
        }

        $classLists = $query->paginate(15);  // Pagination with 10 results per page
        $coursesData = Courses::all();
        $classData = Siniflar::all();

        return view('backend.class.all-list', compact('classLists', 'coursesData', 'classData'));
    }

    public function down(Request $request, $id)
    {
        try {
            $class = KesinKayitForm::findOrFail($id); // Modeli bulun
            $class->sinif_id = null; // sinif_id'yi null yapın
            $class->status = 0;
            $class->save(); // Değişiklikleri kaydedin

            return response()->json(['success' => true, 'message' => 'Sınıf başarıyla sıfırlandı!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Bir hata oluştu!'], 500);
        }
    }

}
