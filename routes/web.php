<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkademikController;
use App\Http\Controllers\AkademikData;
use App\Http\Controllers\AkademikDES;
use App\Http\Controllers\AkademikMA;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Requests;
use GuzzleHttp\Client;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware(['auth','check.auth'])->group(function () {
    Route::get('/guide', function () {
        return view('dashboard.guide');
    });
    Route::get('/home', function () {
        return view('dashboard.home');
    })->name('home');
    Route::resource('/regresi/mahasiswa', AkademikController::class)->names('mhs_regresi');
    Route::resource('/des/mahasiswa', AkademikDES::class)->names('mhs_des');
    Route::resource('/ma/mahasiswa', AkademikMA::class)->names('mhs_ma');
    
    Route::post('/logout', [LoginController::class, 'logout']);
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('/database/akademik', AkademikData::class)->names('database');
    Route::resource('/database/user', UserController::class)->names('database_user');
    Route::post('/upload-data', [AkademikData::class, 'uploadData'])->name('database.uploadData');
    Route::post('/upload-data-baru', [AkademikData::class, 'uploadDataBaru'])->name('database.uploadDataBaru');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::get('/login-face', function (){
        return view('login.index_face_new');
    });
    Route::get('/login-face-check', [LoginController::class, 'login_face']);
    
});

Route::fallback(function () {
    return redirect()->route('login')->with('loginError', 'Login gagal');
});


// Route::get('/mhsregresi', [AkademikController::class, 'cari'])->name('mhs_regresi_cari');
;


// Route::get('/prdregresi', function () {
//     return view('dashboard.predict.prodi');
// });

// Route::get('/fkregresi', function () {
//     return view('dashboard.predict.fakultas');
// });
