<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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

Route::middleware('guest')->group(function (){
    Route::get('/', [LoginController::class, 'index'])->name('login-view');

    Route::post('login', [LoginController::class, 'login'])->name('login');

    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'register'])->name('register.post');
});



Route::middleware('auth')->group(function () {

    
    Route::middleware('auth-user')->prefix('user')->group(function () {
        Route::get('home',function(){
            dd('oke-user');
        });
    });

    Route::middleware('auth-dokter')->prefix('dokter')->group(function () {
        Route::get('home',function(){
            dd('oke-dokter');
        });
    });

    Route::middleware('auth-apoteker')->prefix('apoteker')->group(function () {
        Route::get('home',function(){
            dd('oke-apoteker');
        });
    });
    
});

