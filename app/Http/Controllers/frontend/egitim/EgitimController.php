<?php

namespace App\Http\Controllers\frontend\egitim;

use App\Http\Controllers\Controller;
use App\Http\Controllers\frontend\basvuruformlari\KesinKayitFormController;
use App\Models\Categories;
use App\Models\Courses;
use App\Models\KesinKayitForm;
use Illuminate\Http\Request;

class EgitimController extends Controller
{
    public function egitim_detay($slug)
    {
        // Slug'a göre kursu bulun
        $data = Courses::where('slug', $slug)->orderBy('order', 'asc')->firstOrFail();
        $studentCount = KesinKayitForm::where('kurs_adi', $data->egitim_adi)->count();
        $category = Categories::where('status', 1)
            ->orderBy('name', 'asc')
            ->get();



        // Kurs detaylarını bir görünüme (view) aktarın
        return view('frontend.course.course-detail', compact('data','category','studentCount'));
    }


    public function tum_egitimler()
    {

        $data = Courses::where('status', 1)
            ->orderBy('order', 'asc')
            ->paginate(4);

        $category = Categories::where('status', 1)
            ->orderBy('name', 'asc')
            ->get();

        return view('frontend.course.all-course',compact('data','category'));
    }



    public function kategori_ara(Request $request)
    {
        $category = Categories::where('status', 1)
            ->orderBy('name', 'asc')
            ->get();

        $categoryIds = $request->input('categories', []);

        if (!empty($categoryIds)) {
            // Seçili kategorilere göre kursları filtrele ve sayfala
            $data = Courses::whereIn('category_id', $categoryIds)->paginate(4);
        } else {
            // Eğer kategori seçilmemişse, tüm kursları sayfala
            $data = Courses::paginate(4);
        }

        // Filtrelenmiş kursları bir view'a gönder
        return view('frontend.course.filter-course-resutls', compact('data'),compact('category'));
    }



    public function egitim_ara(Request $request)
    {
            $aranan_kelime = $request->input("search");

        $category = Categories::where('status', 1)
            ->orderBy('name', 'asc')
            ->get();

        $data = Courses::where('status', 1)
            ->where(function($query) use ($aranan_kelime) {
                $query->where('egitim_adi', 'like', "%{$aranan_kelime}%")
                    ->orWhere('detay', 'like', "%{$aranan_kelime}%");
            })
            ->get();

            request()->flash();
          return view('frontend.course.arama',compact('data','category'));

    }


    public function showCategory($id)
    {

        $category = Categories::where('status', 1)
            ->orderBy('name', 'asc')
            ->get();

        $data = Courses::where('category_id', $id)->where('status', 1)
            ->orderBy('order', 'asc')->paginate(4);

        return view('frontend.course.filter-course-resutls',compact('data','category'));

    }

}
