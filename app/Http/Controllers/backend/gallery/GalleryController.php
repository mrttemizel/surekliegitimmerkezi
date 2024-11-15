<?php

namespace App\Http\Controllers\backend\gallery;

use App\Http\Controllers\backend\gallery\GalleryImageController;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::all();
        return view('backend.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('backend.galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $coverImage = $request->file('cover_image')->store('uploads/galleries', 'public');

        $gallery = Gallery::create([
            'title' => $request->title,
            'cover_image' => $coverImage,
            'status' => $request->status ?? 'active',
        ]);

        return redirect()->route('gallery.index')->with('success', 'Gallery created successfully.');
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('backend.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('cover_image')) {
            Storage::delete($gallery->cover_image);
            $data['cover_image'] = $request->file('cover_image')->store('uploads/galleries', 'public');
        }

        $gallery->update($data);

        return redirect()->route('gallery.index')->with('success', 'Gallery updated successfully.');
    }

    public function delete($id)
    {
        $gallery = Gallery::findOrFail($id);

        Storage::delete($gallery->cover_image);
        $gallery->images()->delete();
        $gallery->delete();

        return redirect()->route('gallery.index')->with('success', 'Gallery deleted successfully.');
    }

    public function addImages($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('backend.galleries.add-images', compact('gallery'));
    }

    public function uploadImages(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('uploads/gallery_images', 'public');

                GalleryImage::create([
                    'gallery_id' => $gallery->id,
                    'image_path' => $imagePath,
                ]);
            }
        }

        return redirect()->route('gallery.manageImages', $gallery->id)->with('success', 'Images uploaded successfully.');
    }

    public function deleteImage($imageId)
    {
        $image = GalleryImage::findOrFail($imageId);

        Storage::delete($image->image_path);
        $image->delete();

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }
    public function manageImages($id)
    {
        $gallery = Gallery::with('images')->findOrFail($id);
        return view('backend.galleries.manage-images', compact('gallery'));
    }

    public function show($id)
    {
        $gallery = Gallery::with('images')->findOrFail($id);
        return view('admin.galleries.show', compact('gallery'));
    }
}
