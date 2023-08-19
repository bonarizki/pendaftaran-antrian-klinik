<?php

use App\Http\Controllers\ApotekerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('email',function(){
    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
   
    \Mail::to('bonarizki.br@gmail.com')->send(new \App\Mail\MyTestMail($details));
   
    dd("Email is Sent.");

});

Route::middleware('guest')->group(function (){
    Route::get('/', [LoginController::class, 'index'])->name('login-view');

    Route::post('login', [LoginController::class, 'login'])->name('login');

    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'register'])->name('register.post');
});



Route::middleware('auth')->group(function () {

    
    Route::middleware('auth-user')->prefix('user')->group(function () {
        Route::get('home',[UserController::class, 'index'])->name('home.user');
        Route::post('daftar-antrian', [UserController::class, 'daftar'])->name('daftar-antrian');
        Route::get('cek-antrian',[UserController::class, 'cek'])->name('cek');
        Route::get('antrian-obat', [UserController::class, 'antrianObat'])->name('antrian-obat-user');
        Route::get('obat-antrian', [UserController::class, 'getAntrianObat'])->name('get-antrian-obat');
        Route::get('done', [UserController::class, 'done']);
    });

    Route::middleware('auth-dokter')->prefix('dokter')->group(function () {
        Route::get('home', [DokterController::class, 'index'])->name('dokter.home');
        Route::get('nomor-antrian', [DokterController::class, 'nomorAntrian'])->name('antrian-pasien');
        Route::post('simpan-resep', [DokterController::class, 'simpanResep'])->name('simpan-resep');

    });

    Route::middleware('auth-apoteker')->prefix('apoteker')->group(function () {
        Route::get('home', [ApotekerController::class, 'index'])->name('apoteker-home');
        Route::get('nomor-antrian', [ApotekerController::class, 'nomorAntrian'])->name('antrian-obat');
        Route::post('antrian-selesai', [ApotekerController::class, 'antrianSelesai'])->name('antrian-selesai');
    });
    
});

