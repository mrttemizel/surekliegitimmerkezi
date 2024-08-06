<?php

namespace App\Http\Controllers\backend\slider;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{

    public function orders(Request $request)
    {
        foreach ($request->get('slider') as $key => $id) {
            Slider::where('id', $id)->update(['order' => $key]);
        }

    }


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
        $data = Slider::findOrFail($request->id);
        $data->status = $request->status=="true" ? 1 : 0;
        $data->save();
    }


    public function index()
    {
        $data = slider::orderBy('order', 'asc')->get(); // 'asc' yerine 'desc' kullanarak azalan sıralama yapabilirsiniz
        return view('backend.slider.index',compact('data'));
    }

    public function delete($id)
    {
        $data = Slider::find($id);

        $path = public_path() . '/slider/' . $data->image;

        if (\File::exists($path)) {
            \File::delete($path);
        }
        $query = $data->delete();
        if (!$query) {
            return back()->with($this->toastr('Slider Silerken Hata Oluştu','error'));
        } else {
            return back()->with($this->toastr('Slider Silme Başarılı','success'));
        }
    }

    public function edit($id)
    {

        return view('backend.slider.edit', [
            'data' => Slider::where('id', $id)->first(),
        ]);
    }

    public function update(Request $request)
    {

        $data = Slider::find($request->id);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,jpeg,png,svg|max:3024',
            ]);

            $path = public_path() . '/slider/' . $data->image;

            if (\File::exists($path)) ;
            {
                \File::delete($path);
            }

            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $base_name = 'SEM-Slider';
            $directory = public_path('slider');
            $counter = 1;
            $image_name = $base_name . '-' . $counter . '.' . $extension;

            while (file_exists($directory . '/' . $image_name)) {
                $counter++;
                $image_name = $base_name . '-' . $counter . '.' . $extension;
            }
            $image->move($directory, $image_name);
            $data->image = $image_name;
        }

        $data->slider_ust_baslik = $request->input('slider_ust_baslik');
        $data->slider_aciklama = $request->input('slider_aciklama');
        $data->slider_button_link = $request->input('slider_button_link');
        $data->slider_video_link = $request->input('slider_video_link');



        $query = $data->save();
        if (!$query) {
            return back()->with($this->toastr('Slider Güncelleme Hata Oluştu','error'));
        } else {
            return redirect()->route('slider.index')->with($this->toastr('Slider Güncelleme Başarılı','success'));
        }

    }


   public  function create()
   {
       return view('backend.slider.create');
   }

   public function store(Request $request)
   {
       $data = new Slider();

       if ($request->hasFile('image')) {
           $request->validate([
               'image' => 'image|mimes:jpg,jpeg,png,svg|max:3024',
           ]);

           $image = $request->file('image');
           $extension = $image->getClientOriginalExtension();
           $base_name = 'SEM-Slider';
           $directory = public_path('slider');
           $counter = 1;
           $image_name = $base_name . '-' . $counter . '.' . $extension;

           while (file_exists($directory . '/' . $image_name)) {
               $counter++;
               $image_name = $base_name . '-' . $counter . '.' . $extension;
           }
           $image->move($directory, $image_name);
           $data->image = $image_name;
       }

       if ($request->hasFile('image_mobil')) {
           $request->validate([
               'image_mobil' => 'image|mimes:jpg,jpeg,png,svg|max:3024',
           ]);

           $image_mobil = $request->file('image_mobil');
           $extension = $image_mobil->getClientOriginalExtension();
           $base_name = 'SEM-Slider-Mobile';
           $directory = public_path('slider');
           $counter_mobil = 1;
           $image_mobil_name = $base_name . '-' . $counter_mobil . '.' . $extension;

           while (file_exists($directory . '/' . $image_mobil_name)) {
               $counter_mobil++;
               $image_mobil_name = $base_name . '-' . $counter_mobil . '.' . $extension;
           }
           $image_mobil->move($directory, $image_mobil_name);
           $data->image_mobil = $image_mobil_name;
       }

       $data->slider_ust_baslik = $request->input('slider_ust_baslik');
       $data->slider_aciklama = $request->input('slider_aciklama');
       $data->slider_button_link = $request->input('slider_button_link');
       $data->slider_video_link = $request->input('slider_video_link');


       $query = $data->save();
       if (!$query) {
           return back()->with('error', 'Slider eklenirken bir hata oluştu!');
       } else {
           return back()->with($this->toastr('Slider Ekleme Başarılı','success'));
       }
   }
}
