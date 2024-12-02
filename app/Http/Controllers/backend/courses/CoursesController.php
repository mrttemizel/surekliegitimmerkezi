<?php

namespace App\Http\Controllers\backend\courses;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Courses;
use App\Models\KesinKayitForm;
use App\Models\Siniflar;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class CoursesController extends Controller
{

    public  function  toastr($message,$alertType)
    {
        $notification = array(
            'message' => $message,
            'alert-type' => $alertType
        );

        return $notification;
    }

    public function switch(Request $request)
    {
        $data = Courses::findOrFail($request->id);
        $class = Siniflar::where('egitim_id', $data->id)->get();

        if (!$class->isEmpty()) {
            $data->status = $request->status == 1 ? 1 : 0; // Boolean kontrolü
            $data->save();

            return response()->json(['success' => true]);
        } else {
            $data->status = $request->status == 1 ? 1 : 0; // Boolean kontrolü
            $data->kesin_kayit = "off";
            $data->kimlik = "off";
            $data->diploma = "off";
            $data->kurumkarti = "off";
            $data->save();

            return response()->json(['success' => false, 'message' => 'Sınıfınız yoktur. Sadece Ön Kayıt Açabilirsiniz.']);
        }
    }
    public function index()
    {
        $data = Courses::all();
        $classes = Siniflar::all();
        return view('backend.courses.index', compact('data','classes'));
    }

    public function create()
    {
        $categories = Categories::all();
        return view('backend.courses.create',compact('categories'));
    }


    public function  store(Request $request)
    {

        $request->validate([
            'egitim_adi' => 'required',
            'category_id' => 'required',
            'order' => 'required',
        ]);
       /* if ($request->input('kesin_kayit') === 'on' && !$request->hasAny(['kimlik', 'diploma', 'kurumkarti'])) {
            return back()->withErrors(['belgeler' => 'Kesin kayıt seçilmişse, formda istenilen belgelerden en az bir tanesinin seçilmesi gerekmektedir.'])->withInput();
        }*/


        $data = new Courses();
        $data->egitim_adi = $request->input('egitim_adi');
        $data->egitim_adi_ing = $request->input('egitim_adi_ing');
        $data->category_id = $request->input('category_id');
        $data->egitim_kordinatorleri = $request->input('egitim_kordinatorleri');
        $data->egitim_saati = $request->input('egitim_saati');
        $data->egitim_baslangic_tarihi = $request->input('egitim_baslangic_tarihi');
        $data->egitim_bitis_tarihi = $request->input('egitim_bitis_tarihi');
        $data->egitim_platformu = $request->input('egitim_platformu');
        $data->egitim_yeri = $request->input('egitim_yeri');
        $data->egitici_adi = $request->input('egitici_adi');
        $data->egitim_ücreti = $request->input('egitim_ücreti');
        $data->egitim_katilim_sarti = $request->input('egitim_katilim_sarti');
        $data->egitim_kontejyani = $request->input('egitim_kontejyani');
        $data->order = $request->input('order');
        $data->detay = $request->input('detay');
        $data->status = 0;
        $data->on_basvuru = $request->input('on_basvuru') === 'on' ? 'on' : 'off';
        $data->kesin_kayit = $request->input('kesin_kayit') === 'on' ? 'on' : 'off';
        $data->kimlik = $request->input('kimlik') === 'on' ? 'on' : 'off';
        $data->diploma = $request->input('diploma') === 'on' ? 'on' : 'off';
        $data->kurumkarti = $request->input('kurumkarti') === 'on' ? 'on' : 'off';


        $data->slug = Str::slug($request->input('egitim_adi'));

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,jpeg,png,svg|max:4048',
            ]);

            $file = $request->file('image');
            $imagename = Str::slug($request->input('egitim_adi')).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('courses'), $imagename);
            $data->image = $imagename;

        }

        $query = $data->save();
        if (!$query) {
            return back()->with('error', 'Eklenirken bir hata oluştu!');
        } else {
            return redirect()->route('courses.index')->with($this->toastr('Eğitim Ekleme Başarılı','success'));
        }

    }

    public function delete($id)
    {
        $data = Courses::find($id);

        $path = public_path() . '/courses/' . $data->image;

        if (\File::exists($path)) {
            \File::delete($path);
        }
        $query = $data->delete();
        if (!$query) {
            return back()->with($this->toastr('Ders Silerken Hata Oluştu','error'));
        } else {
            return back()->with($this->toastr('Ders Silme Başarılı','success'));
        }
    }



    public function edit($id)
    {
        $data = Courses::where('id', $id)->first();
        $categories = Categories::all();
        return view('backend.courses.edit', compact('data', 'categories'));
    }


    public function update(Request $request)
    {
        $data = Courses::where('id', $request->id)->first();

        $request->validate([
            'egitim_adi' => 'required',
            'category_id' => 'required',
            'order' => 'required',
        ]);

        $data->egitim_adi = $request->input('egitim_adi');
        $data->egitim_adi_ing = $request->input('egitim_adi_ing');
        $data->category_id = $request->input('category_id');
        $data->egitim_kordinatorleri = $request->input('egitim_kordinatorleri');
        $data->egitim_saati = $request->input('egitim_saati');
        $data->egitim_baslangic_tarihi = $request->input('egitim_baslangic_tarihi');
        $data->egitim_bitis_tarihi = $request->input('egitim_bitis_tarihi');
        $data->egitim_platformu = $request->input('egitim_platformu');
        $data->egitim_yeri = $request->input('egitim_yeri');
        $data->egitici_adi = $request->input('egitici_adi');
        $data->egitim_ücreti = $request->input('egitim_ücreti');
        $data->egitim_katilim_sarti = $request->input('egitim_katilim_sarti');
        $data->egitim_kontejyani = $request->input('egitim_kontejyani');
        $data->order = $request->input('order');
        $data->detay = $request->input('detay');


        $data->slug = Str::slug($request->input('egitim_adi'));

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,jpeg,png,svg|max:4048',
            ]);

            $path = public_path() . '/courses/' . $data->image;

            if (\File::exists($path)) ;
            {
                \File::delete($path);
            }

            $file = $request->file('image');
            $imagename = Str::slug($request->input('egitim_adi')).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('courses'), $imagename);
            $data->image = $imagename;

        }
        $query = $data->update();

        if (!$query) {
            return back()->with($this->toastr('Eğitim Güncelleme Başarısız','error'));
        } else {
            return redirect()->route('courses.index')->with($this->toastr('Eğitim Güncelleme Başarılı','success'));
        }
    }

    public function uploadExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,csv',
            'class_id' => 'required|integer',
            'course_id' => 'required|integer',
        ]);

        $path = $request->file('excel_file')->getRealPath();
        $course_data = Courses::where('id', $request->course_id)->first();

        $data = Excel::toArray([], $request->file('excel_file'))[0];
        $data = array_slice($data, 1);

        foreach ($data as $row) {
            $class = new KesinKayitForm();
            $class->sinif_id = $request->class_id;
            $class->kurs_id = $request->course_id;
            $class->kurs_adi = $course_data->egitim_adi;
            $class->kvkk = 'on';
            $class->name = $row[0];
            $class->surname = $row[1];
            $class->email = $row[2];
            $class->phone = $row[3];
            $class->tc = $row[4];
            $class->address = $row[5];
            $class->status = 0;
            $class->save();
        }

        return redirect()->back()->with('success', 'Excel verileri başarıyla yüklendi.');
    }
    public function getClasses(Request $request)
    {
        $course_id = $request->course_id;
        $classes = Siniflar::where('egitim_id', $course_id)->get();

        return response()->json(['classes' => $classes]);
    }
}
