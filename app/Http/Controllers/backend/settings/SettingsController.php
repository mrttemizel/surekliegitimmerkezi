<?php

namespace App\Http\Controllers\backend\settings;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public  function  toastr($message,$alertType)
    {
        $notification = array(
            'message' => $message,
            'alert-type' => $alertType
        );

        return $notification;
    }

    public function index()
    {

        $data = Settings::find(1);
        return view('backend.settings.index', compact('data'));

    }

    public function socialUpdate(Request $request)
    {

        $data = Settings::find(1);

        $data -> instagram = $request->instagram;
        $data -> facebook = $request->facebook;
        $data -> twitter = $request->twitter;
        $data -> linkedin = $request->linkedin;
        $data -> youtube = $request->youtube;

        $query = $data->update();
        if (!$query) {
            return response()->json(['code' => 0, 'msg' => 'NO']);
        } else {
            return response()->json(['code' => 1, 'msg' => 'Güncelleme İşlemi Başarılı']);
        }

    }

    public function contactUpdate(Request $request)
    {
        $data = Settings::find(1);

        $data -> email = $request->email;
        $data -> phonebir = $request->phonebir;
        $data -> phoneiki = $request->phoneiki;
        $data -> address = $request->address;
        $data -> fax = $request->fax;

        $query = $data->update();
        if (!$query) {
            return response()->json(['code' => 0, 'msg' => 'NO']);
        } else {
            return response()->json(['code' => 1, 'msg' => 'Güncelleme İşlemi Başarılı']);
        }
    }

    public function logoUpdate(Request $request)
    {

        $data = Settings::find(1);

        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'image|mimes:jpg,jpeg,png,svg|max:2048',
            ]);

            $path = public_path() . '/logo/' . $data->logo;

            if (\File::exists($path)) ;
            {
                \File::delete($path);
            }
            $logo = $request->file('logo');
            $logo_name = 'SEM' . '-' . 'logo' . '.'  . $logo->getClientOriginalExtension();
            $logo->move(public_path('logo'), $logo_name);
            $data->logo = $logo_name;
        }

        if ($request->hasFile('logo_footer')) {
            $request->validate([
                'logo_footer' => 'image|mimes:jpg,jpeg,png,svg|max:2048',
            ]);

            $path2 = public_path() . '/logo/' . $data->logo_footer;

            if (\File::exists($path2)) ;
            {
                \File::delete($path2);
            }
            $logo_footer = $request->file('logo_footer');
            $logo_footer_name = 'SEM' . '-' . 'logo_footer' . '.' . $logo_footer->getClientOriginalExtension();
            $logo_footer->move(public_path('logo'), $logo_footer_name);
            $data->logo_footer = $logo_footer_name;
        }

        if ($request->hasFile('favicon')) {
            $request->validate([
                'favicon' => 'image|mimes:jpg,jpeg,png,svg|max:2048',
            ]);

            $path3 = public_path() . '/logo/' . $data->favicon;

            if (\File::exists($path3)) ;
            {
                \File::delete($path3);
            }
            $favicon = $request->file('favicon');
            $favicon_name = 'SEM' . '-' . 'favicon' . '.' . $favicon->getClientOriginalExtension();
            $favicon->move(public_path('logo'), $favicon_name);
            $data->favicon = $favicon_name;
        }
        $query = $data->update();
        if (!$query) {
            return back()->with('error', 'Kullanıcı eklenirken bir hata oluştu!');
        } else {
            return back()->with($this->toastr('Kullanıcı Ekleme Başarılı','success'));
        }

    }
}
