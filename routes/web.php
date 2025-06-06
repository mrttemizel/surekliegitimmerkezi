<?php


use App\Http\Controllers\backend\about\BankaIsController;
use App\Http\Controllers\backend\about\EducationRequestController;
use App\Http\Controllers\backend\about\EgitmenlerController;
use App\Http\Controllers\backend\about\FormlarController;
use App\Http\Controllers\backend\about\OrganizationChartController;
use App\Http\Controllers\backend\about\RefundFormController;
use App\Http\Controllers\backend\about\YonetimController;
use App\Http\Controllers\backend\about\YonetimKuruluController;
use App\Http\Controllers\backend\auth\AuthController;
use App\Http\Controllers\backend\basvurular\KesinKayitBasvurulariController;
use App\Http\Controllers\backend\basvurular\OnKayitBasvurulariController;
use App\Http\Controllers\backend\categories\CategoriesController;
use App\Http\Controllers\backend\courses\CoursesController;
use App\Http\Controllers\backend\gallery\GalleryController;
use App\Http\Controllers\backend\sertifika\EDevletController;
use App\Http\Controllers\backend\sertifika\SertifikaController;
use App\Http\Controllers\backend\settings\SettingsController;
use App\Http\Controllers\backend\siniflar\SiniflarController;
use App\Http\Controllers\backend\slider\SliderController;
use App\Http\Controllers\backend\user\UserController;
use App\Http\Controllers\TemplateSettingsController;
use Illuminate\Support\Facades\Route;

// Frontend routes
require __DIR__ . '/frontend.php';

Route::get('pwd', function () { return bcrypt('123456789');});


Route::get('/login',[AuthController::class,'login'])->name('auth.login');
Route::post('/login-submit',[AuthController::class,'login_submit'])->name('auth.login-submit');
Route::get('/reset-password',[AuthController::class,'reset_password_page'])->name('auth.reset_password');
Route::post('/reset-password-link',[AuthController::class,'reset_password_link'])->name('auth.reset-password-link');
Route::get('/admin/reset-password/{token}/{email}',[AuthController::class,'reset_password'])->name('auth.reset_password_link');
Route::post('/reset-password-submit',[AuthController::class,'reset_password_submit'])->name('auth.reset_password_submit');


Route::middleware('auth')->group(function (){
    Route::prefix('dashboard')->group(function(){
        Route::get('/',[AuthController::class,'index'])->name('auth.index');
        Route::get('/logout',[AuthController::class,'logout'])->name('auth.logout');



        // Profile routes
        Route::get('/profile',[UserController::class,'profile'])->name('user.profile');
        Route::post('/profile/profile-image-update',[UserController::class,'profile_image_update'])->name('users.profile.image.update');
        Route::post('/profile/profile-information-update',[UserController::class,'profile_information_update'])->name('users.profile.information.update');
        Route::post('/profile/profile-password-update',[UserController::class,'profile_password_update'])->name('users.profile.password.update');


        // User routes
        Route::get('/users/create',[UserController::class,'create'])->name('users.create')->middleware('adminStatus');
        Route::post('/users/store',[UserController::class,'store'])->name('users.store')->middleware('adminStatus');
        Route::get('/users/index',[UserController::class,'index'])->name('users.index')->middleware('adminStatus');
        Route::get('/users/delete/{id}',[UserController::class,'delete'])->name('users.delete')->middleware('adminStatus');
        Route::get('/users/edit/{id}',[UserController::class,'edit'])->name('users.edit')->middleware('adminStatus');
        Route::post('/user/image-update',[UserController::class,'image_update'])->name('users.image.update')->middleware('adminStatus');
        Route::post('/user/information-update',[UserController::class,'information_update'])->name('users.information.update')->middleware('adminStatus');
        Route::post('/user/password-update',[UserController::class,'password_update'])->name('users.password.update')->middleware('adminStatus');


        // Settings routes
        Route::get('/settings',[SettingsController::class,'index'])->name('settings.index');
        Route::post('/settings/socialUpdate',[SettingsController::class,'socialUpdate'])->name('settings.social.update');
        Route::post('/settings/contactUpdate',[SettingsController::class,'contactUpdate'])->name('settings.contact.update');
        Route::post('/settings/logoUpdate',[SettingsController::class,'logoUpdate'])->name('settings.logo.update');



        // Slider routes
        Route::get('/slider',[SliderController::class,'index'])->name('slider.index');
        Route::get('/slider/create',[SliderController::class,'create'])->name('slider.create');
        Route::post('/slider/create',[SliderController::class,'store'])->name('slider.store');
        Route::get('/slider/edit/{id}',[SliderController::class,'edit'])->name('slider.edit');
        Route::post('/slider/update',[SliderController::class,'update'])->name('slider.update');
        Route::get('/slider/delete/{id}',[SliderController::class,'delete'])->name('slider.delete');
        Route::get('/slider/siralama',[SliderController::class,'orders'])->name('slider.orders');
        Route::get('/slider/switch',[SliderController::class,'switch'])->name('slider.switch');


        // Eğtimler routes
        Route::get('/courses',[CoursesController::class,'index'])->name('courses.index');
        Route::get('/courses/create',[CoursesController::class,'create'])->name('courses.create');
        Route::post('/courses/create',[CoursesController::class,'store'])->name('courses.store');
        Route::get('/courses/edit/{id}',[CoursesController::class,'edit'])->name('courses.edit');
        Route::post('/courses/update',[CoursesController::class,'update'])->name('courses.update');
        Route::get('/courses/delete/{id}',[CoursesController::class,'delete'])->name('courses.delete');
        Route::get('/courses/switch',[CoursesController::class,'switch'])->name('courses.switch');
        Route::post('/courses/upload-excel', [CoursesController::class, 'uploadExcel'])->name('courses.uploadExcel');
        Route::get('/courses/getClasses', [CoursesController::class, 'getClasses'])->name('courses.getClasses');


        // Categories routes
        Route::get('/categories',[CategoriesController::class,'index'])->name('categories.index');
        Route::post('/categories/create',[CategoriesController::class,'store'])->name('categories.store');
        Route::get('/categories/delete/{id}',[CategoriesController::class,'delete'])->name('categories.delete');
        Route::get('/categories/switch',[CategoriesController::class,'switch'])->name('categories.switch');
        Route::get('/categories/getData',[CategoriesController::class,'getData'])->name('categories.getData');
        Route::post('/categories/update',[CategoriesController::class,'update'])->name('categories.update');

        //  About routes
        Route::get('/yonetim',[YonetimController::class,'index'])->name('yonetim.index');
        Route::post('/yonetim',[YonetimController::class,'store'])->name('yonetim.store');
        Route::get('/yonetim/switch',[YonetimController::class,'switch'])->name('yonetim.switch');
        Route::get('/yonetim/getData',[YonetimController::class,'getData'])->name('yonetim.getData');
        Route::post('/yonetim/update',[YonetimController::class,'update'])->name('yonetim.update');
        Route::get('/yonetim/delete/{id}',[YonetimController::class,'delete'])->name('yonetim.delete');
        Route::get('/yonetim/siralama',[YonetimController::class,'orders'])->name('yonetim.orders');

        Route::get('/yonetimkurulu',[YonetimKuruluController::class,'index'])->name('yonetimkurulu.index');
        Route::post('/yonetimkurulu',[YonetimKuruluController::class,'store'])->name('yonetimkurulu.store');
        Route::get('/yonetimkurulu/switch',[YonetimKuruluController::class,'switch'])->name('yonetimkurulu.switch');
        Route::get('/yonetimkurulu/getData',[YonetimKuruluController::class,'getData'])->name('yonetimkurulu.getData');
        Route::post('/yonetimkurulu/update',[YonetimKuruluController::class,'update'])->name('yonetimkurulu.update');
        Route::get('/yonetimkurulu/delete/{id}',[YonetimKuruluController::class,'delete'])->name('yonetimkurulu.delete');
        Route::get('/yonetimkurulu/siralama',[YonetimKuruluController::class,'orders'])->name('yonetimkurulu.orders');

        Route::get('/egitmenler',[EgitmenlerController::class,'index'])->name('egitmenler.index');
        Route::post('/egitmenler',[EgitmenlerController::class,'store'])->name('egitmenler.store');
        Route::get('/egitmenler/switch',[EgitmenlerController::class,'switch'])->name('egitmenler.switch');
        Route::get('/egitmenler/getData',[EgitmenlerController::class,'getData'])->name('egitmenler.getData');
        Route::post('/egitmenler/update',[EgitmenlerController::class,'update'])->name('egitmenler.update');
        Route::get('/egitmenler/delete/{id}',[EgitmenlerController::class,'delete'])->name('egitmenler.delete');
        Route::get('/egitmenler/siralama',[EgitmenlerController::class,'orders'])->name('egitmenler.orders');


        Route::get('/formlar',[FormlarController::class,'index'])->name('formlar.index');
        Route::post('/formlar',[FormlarController::class,'store'])->name('formlar.store');
        Route::get('/formlar/switch',[FormlarController::class,'switch'])->name('formlar.switch');
        Route::get('/formlar/getData',[FormlarController::class,'getData'])->name('formlar.getData');
        Route::post('/formlar/update',[FormlarController::class,'update'])->name('formlar.update');
        Route::get('/formlar/delete/{id}',[FormlarController::class,'delete'])->name('formlar.delete');


        Route::get('/banka-isbirlikleri',[BankaIsController::class,'index'])->name('banka-is.index');
        Route::post('/banka-isbirlikleri',[BankaIsController::class,'update'])->name('banka-is.update');

        Route::get('/education-request',[EducationRequestController::class,'index'])->name('education-request.index');
        Route::post('/education-request',[EducationRequestController::class,'update'])->name('education-request.update');

        Route::get('/organization-chart',[OrganizationChartController::class,'index'])->name('organization-chart.index');
        Route::post('/organization-chart',[OrganizationChartController::class,'update'])->name('organization-chart.update');
        Route::post('/organization-chart/upload', [OrganizationChartController::class, 'uploadImage'])->name('organization-chart.upload');


        Route::get('/refund-form',[RefundFormController::class,'index'])->name('refund-form.index');
        Route::post('/refund-form',[RefundFormController::class,'store'])->name('refund-form.store');
        Route::post('/refund-form',[RefundFormController::class,'update'])->name('refund-form.update');
        Route::post('/refund-form/upload', [RefundFormController::class, 'uploadImage'])->name('refund-form.upload');

        Route::get('/on-kayit-basvurulari',[OnKayitBasvurulariController::class,'index'])->name('on-kayit-basvurulari.index');
        Route::get('/on-kayit', [OnKayitBasvurulariController::class, 'index'])->name('on-kayit.index');

        Route::get('/on-kayit-basvurulari/delete/{id}',[OnKayitBasvurulariController::class,'delete'])->name('on-kayit-basvurulari.delete');

        Route::get('/kesin-kayit-basvurulari',[KesinKayitBasvurulariController::class,'index'])->name('kesin-kayit-basvurulari.index');
        Route::get('/kesin-kayit-basvurulari/delete/{id}',[KesinKayitBasvurulariController::class,'delete'])->name('kesin-kayit-basvurulari.delete');
        Route::get('/kesin-kayit-basvurulari/getData',[KesinKayitBasvurulariController::class,'getData'])->name('kesin-kayit-basvurulari.getData');
        Route::get('/kesin-kayit-basvurulari/edit/{id}',[KesinKayitBasvurulariController::class,'edit'])->name('kesin-kayit-basvurulari.edit');
        Route::post('/kesin-kayit-basvurulari/update',[KesinKayitBasvurulariController::class,'update'])->name('kesin-kayit-basvurulari.update');
        Route::get('/kesin-kayit-basvurulari/getSinif',[KesinKayitBasvurulariController::class,'getSinif'])->name('kesin-kayit-basvurulari.getSinif');
        Route::post('/kesin-kayit-basvurulari/sinifAta',[KesinKayitBasvurulariController::class,'sinifAta'])->name('kesin-kayit-basvurulari.sinifAta');



        // Sınıflar routes
        Route::get('/class',[SiniflarController::class,'index'])->name('class.index');
        Route::get('/class/create',[SiniflarController::class,'create'])->name('class.create');
        Route::post('/class/create',[SiniflarController::class,'store'])->name('class.store');
        Route::get('/class/edit/{id}',[SiniflarController::class,'edit'])->name('class.edit');
        Route::post('/class/update',[SiniflarController::class,'update'])->name('class.update');
        Route::get('/class/delete/{id}',[SiniflarController::class,'delete'])->name('class.delete');


        Route::get('/class/students',[SiniflarController::class,'list'])->name('class.list');
        Route::get('/class/old-students',[SiniflarController::class,'oldList'])->name('class.old-list');
        Route::get('/class/filter', [SiniflarController::class, 'filter'])->name('class.filter');
        Route::get('/class/filterold', [SiniflarController::class, 'filterold'])->name('class.filterold');
        Route::get('/class/students/switch', [SiniflarController::class, 'switch'])->name('class.switch');
        Route::match(['get', 'post'], '/class/down/{id}',[SiniflarController::class,'down'])->name('class.down');
        Route::get('/class/makeactive/{id}',[SiniflarController::class,'makeactive'])->name('class.makeactive');
        Route::get('/class/lists', [SiniflarController::class, 'allList'])->name('class.all-list');


        Route::post('/generate-certificates', [SertifikaController::class, 'generateCertificates'])->name('certificates.generate');

        Route::get('/certificates/{tc}', [EDevletController::class, 'getCertificatesByTcKimlikNo']);
        Route::post('/settings/social/update', [TemplateSettingsController::class, 'update'])->name('settings.social.update');
        Route::post('/settings/social/updatecus', [TemplateSettingsController::class, 'updatecus'])->name('settings.social.updatecus');
        Route::post('/settings/social/updatetr', [TemplateSettingsController::class, 'updatetr'])->name('settings.social.updatetr');
        // Sınıflar routes

        Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
        Route::get('/gallery/{id}', [GalleryController::class, 'show'])->name('gallery.show');
        Route::get('/galleries/create', [GalleryController::class, 'create'])->name('gallery.admincreate');
        Route::get('/gallery/edit/{id}',[GalleryController::class,'edit'])->name('gallery.edit');
        Route::post('gallery/store', [GalleryController::class, 'store'])->name('gallery.store');
        Route::put('/gallery/update/{id}', [GalleryController::class, 'update'])->name('gallery.update');
        Route::delete('/gallery/delete/{id}', [GalleryController::class, 'delete'])->name('gallery.delete');
        Route::get('/gallery/{id}/add-images', [GalleryController::class, 'addImages'])->name('gallery.addImages');
        Route::post('/gallery/{id}/upload-images', [GalleryController::class, 'uploadImages'])->name('gallery.uploadImages');
        Route::get('/gallery/{id}/manage-images', [GalleryController::class, 'manageImages'])->name('gallery.manageImages');
        Route::delete('/gallery/image/{imageId}/delete', [GalleryController::class, 'deleteImage'])->name('gallery.deleteImage');

    });
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/refund-forms', [RefundformController::class, 'index'])->name('refundform.index');
    Route::post('/refund-forms/store', [RefundformController::class, 'store'])->name('refundform.store');
    Route::get('/refund-forms/get-data', [RefundformController::class, 'getData'])->name('refundform.getData');
    Route::post('/refund-forms/update', [RefundformController::class, 'update'])->name('refundform.update');
    Route::get('/refund-forms/delete/{id}', [RefundformController::class, 'delete'])->name('refundform.delete');
    Route::get('/refund-forms/switch', [RefundformController::class, 'switch'])->name('refundform.switch');
    Route::get('/kesin-kayit-basvurulari/delete/{id}', [KesinKayitBasvurulariController::class, 'delete'])
        ->name('kesin.kayit.basvurulari.delete');
    Route::get('/on-kayit-basvurulari/delete/{id}', [OnKayitBasvurulariController::class, 'delete'])
        ->name('on.kayit.basvurulari.delete');
});

Route::get('/ucret-iade-formlari', [App\Http\Controllers\frontend\RefundformController::class, 'index'])
    ->name('frontend.refundform.index');

Route::get('/ucret-iade-formlari/{id}/delete', [App\Http\Controllers\frontend\RefundformController::class, 'delete'])
    ->name('frontend.refundform.delete')
    ->middleware('auth');

// KVKK ve ilgili sayfalar
Route::get('/kvkk', [App\Http\Controllers\frontend\KvkkController::class, 'kvkk'])->name('kvkk');
Route::get('/acik-riza', [App\Http\Controllers\frontend\KvkkController::class, 'acikRiza'])->name('acik.riza');
Route::get('/sem-web-kullanim', [App\Http\Controllers\frontend\KvkkController::class, 'webKullanim'])->name('web.kullanim');
