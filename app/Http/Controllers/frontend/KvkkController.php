<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;

class KvkkController extends Controller
{
    public function kvkk()
    {
        return view('frontend.kvkk.kvkk');
    }

    public function acikRiza()
    {
        return view('frontend.kvkk.acik-riza');
    }

    public function webKullanim()
    {
        return view('frontend.kvkk.web-kullanim');
    }
} 