<?php

namespace App\Http\Controllers\frontend\home;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        Carbon::setLocale('tr'); // 'tr' for Turkish
        $courses_nows = Courses::where('egitim_baslangic_tarihi', '>=', Carbon::now())
            ->orderBy('egitim_baslangic_tarihi')
            ->limit(4)
            ->get();
        $slider = Slider::orderBy('order')->get();
        $courses = Courses::where('status', 1)
            ->orderBy('egitim_adi', 'asc')
            ->take(4)->get();
        return view('frontend.index', compact('slider','courses','courses_nows'));
    }
}
