<?php

namespace App\Http\Controllers\frontend\gallery;

use App\Http\Controllers\Controller;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryFrontController extends Controller
{
    public function index()
    {
        $galleries = Gallery::where('status', 'active')->get();
        return view('frontend.galleries.index', compact('galleries'));
    }


    public function show($id)
    {
        $gallery = Gallery::with('images')->findOrFail($id);
        return view('frontend.galleries.show', compact('gallery'));
    }

}
