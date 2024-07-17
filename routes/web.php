<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::resource('/', ArsipController::class);
    Route::resource('about', AboutController::class);
    Route::resource('kategori', KategoriController::class);
    Route::post('/kategori-data', [KategoriController::class, 'data']);
    Route::resource('arsip', ArsipController::class);
    Route::post('/arsip-data', [ArsipController::class, 'data']);
    Route::get('/arsip/{id}/download', [ArsipController::class, 'downloadArsip'])->name('arsip.download');

    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
