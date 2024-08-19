<?php

namespace App\Http\Controllers\backend\auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Mail\UserRegisterMail;
use App\Models\KesinKayitForm;
use App\Models\OnBasvuruForm;
use App\Models\Siniflar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\Websiteemail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Charts\MonthlyUsersChart;

use TimeHunter\LaravelGoogleReCaptchaV2\Validations\GoogleReCaptchaV2ValidationRule;

use Illuminate\Http\RedirectResponse;
class AuthController extends Controller
{
    public function login(){
        return view('backend.auth.login');
    }


    public function index(){
        $data = Siniflar::all();
        $on_data = OnBasvuruForm::all();
        $statusCounts = [
            'tamamlanan' => $data->where('sinif_durumu', 2)->count(),
            'devam_eden' => $data->where('sinif_durumu', 1)->count(),
        ];

        $ksn_data = KesinKayitForm::all()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m'); // grouping by year and month
        });

        // Initialize an array to store the counts per month
        $monthlyCounts = [];

        // Iterate through the grouped data to get the counts
        foreach ($ksn_data as $month => $data) {
            $monthlyCounts[$month] = $data->count();
        }


        return view('backend.index', compact('statusCounts','monthlyCounts'));
    }

    public function reset_password_page(){
        return view('backend.auth.reset-password');
    }
    public function login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'g-recaptcha-response' => [new GoogleReCaptchaV2ValidationRule()]

        ]);

        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $notification = array(
            'message' => 'Giriş Başarılı',
            'alert-type' => 'success'
        );

        if(Auth::attempt($credential)){

                return redirect()->route('auth.index')->with($notification);

        } else {
            return back()->with('error','Girilen Bilgiler Doğru Değil!');
        }
    }


    public function logout()
    {
        $notification = array(
            'message' => 'Çıkış İşlemi Başarılı',
            'alert-type' => 'success'
        );

        Auth::logout();
        return redirect()->route('auth.login')->with($notification);
    }


    public function reset_password_link(Request $request){
        $request->validate([
            'email' => 'required|email',
             'g-recaptcha-response' => [new GoogleReCaptchaV2ValidationRule()]
        ]);


        $data = User::where('email',$request->email)->first();
        if(!$data)
        {
            return back()->with('error','Bu E-posta adresi sisteme kayıtlı değil.');
        }

        $token = hash('sha256',time());
        $data->token=$token;
        $data -> update();
        $reset_link = url('admin/reset-password/'.$token.'/'.$request->email);
        $subject = 'Reset Password';
        $message = 'Please click on the following link: <br>';
        $button = $reset_link;


        Mail::to($request->email)->send(new Websiteemail($subject , $button));


        return back()->with('success','Sfırlama talimatları e-posta adresinize gönderildi!');

    }

    public function reset_password($token, $email)
    {

        $data = User::where('token',$token)->where('email',$email)->first();
        if(!$data)
        {
            return redirect()->route('login');
        }

        return view('backend.auth.change-password',compact('token','email'));
    }

    public function reset_password_submit(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);


        $data = User::where('token',$request->token)->where('email',$request->email)->first();

        if((Hash::check($request->password,$data->password))){
            return back()->with('error','Yeni şifreniz, eski şifreniz ile aynı olamaz!');
        }else{
            $data -> password = Hash::make($request->password);
            $data -> token = '';
            $data -> update();
            return redirect()->route('auth.login')->with('success','Şifreniz değiştirildi');
        }

    }

}
