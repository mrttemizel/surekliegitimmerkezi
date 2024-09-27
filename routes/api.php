<?php

use App\Http\Controllers\backend\sertifika\EDevletController;
use App\Services\SertifikaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::any('/soap', function () {
    $options = [
        'uri' => 'http://127.0.0.1:8000/soap',
        'location' => 'http://127.0.0.1:8000/soap'
    ];

    $server = new \SoapServer(public_path('wsdl/universite.wsdl'), $options);
    $server->setClass(SertifikaService::class);

    // Output buffering to capture the SOAP response
    ob_start();
    $server->handle();
    $response = ob_get_clean();

    // Return the response with correct headers
    return response($response, 200)
        ->header('Content-Type', 'text/xml; charset=utf-8');
});
Route::get('/test', function () {
    return 'fgdsfTest route is working!';
});
Route::get('/certificates/{tc}', [EDevletController::class, 'getCertificatesByTcKimlikNo']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
