<?php

use App\Http\Controllers\frontend\about\AboutController;
use App\Http\Controllers\frontend\basvuruformlari\KesinKayitFormController;
use App\Http\Controllers\frontend\basvuruformlari\OnKayitFormController;
use App\Http\Controllers\frontend\egitim\EgitimController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\home\HomeController;




Route::get('/',[HomeController::class,'index'])->name('home.index');



Route::get('/egitim-detay/{slug}',[EgitimController::class,'egitim_detay'])->name('egitim_detay.index');
Route::get('/tum-egitimler',[EgitimController::class,'tum_egitimler'])->name('tum_egitimler.index');
Route::post('/egitim-ara', [EgitimController::class, 'egitim_ara'])->name('tum_egitimler.egitimAra');
Route::get('/kategori-ara', [EgitimController::class, 'kategori_ara'])->name('tum_egitimler.kategoriAra');
Route::get('/show-category/{id}', [EgitimController::class, 'showCategory'])->name('tum_egitimler.showCategory');


Route::get('/kvkk', function () {
    return view('frontend/kvkk/kvkk'); //
})->name('kvkk');


Route::get('/hakkimizda/yonetim',[AboutController::class,'yonetim'])->name('hakkimizda_yonetim.index');
Route::get('/hakkimizda/iletisim',[AboutController::class,'iletisim'])->name('hakkimizda_iletisim.index');
Route::post('/hakkimizda/iletisim',[AboutController::class,'sendMail'])->name('hakkimizda_iletisim.sendMail');
Route::get('/hakkimizda/formlar',[AboutController::class,'formlar'])->name('hakkimizda_formlar.index');
Route::get('/hakkimizda/egitmenler',[AboutController::class,'egitmenler'])->name('hakkimizda_egitmenler.index');
Route::get('/hakkimizda/yonetim-kurulu',[AboutController::class,'yonetim_kurulu'])->name('hakkimizda_yonetim_kurulu.index');
Route::get('/hakkimizda/banka-hesap-bilgileri',[AboutController::class,'banka_hesap'])->name('hakkimizda_banka_hesap.index');
Route::get('/hakkimizda/is-birligi-yaptigimiz-kurumlar',[AboutController::class,'is_birligi_yaptigimiz_kurumlar'])->name('hakkimizda_is_birligi_yaptigimiz_kurumlar.index');
Route::get('/hakkimizda/is-birligi-yaptigimiz-kurumlara-verilen-egitimler',[AboutController::class,'is_birligi_yaptigimiz_kurumlara_verilen_egitimler'])->name('hakkimizda_is_birligi_yaptigimiz_kurumlara_verilen_egitimler.index');



Route::get('/form/kesin-kayit-form/{slug}',[KesinKayitFormController::class,'kesinKayitForm'])->name('form.kesin-kayit-form');
Route::post('/form/kesin-kayit-form',[KesinKayitFormController::class,'storeKesinKayitForm'])->name('form.kesin-kayit-form.store');

Route::get('/form/on-kayit-form/{slug}',[OnKayitFormController::class,'onKayitForm'])->name('form-kayit-on.form-kayit-form');
Route::post('/form/on-kayit-form',[OnKayitFormController::class,'storeOnKayitForm'])->name('form-kayit-on.form-kayit-form.store');




?>
