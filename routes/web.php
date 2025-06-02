<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PresenceDetailController;
use App\Http\Controllers\NotulenController;
use App\Http\Controllers\absenController;
use App\Models\Notulen;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [NotulenController::class,'index'])->name('notulen.index');
Route::get('/notulen/{id}', [NotulenController::class, 'show'])->name('notulen.show');
Route::get('/frame1', [NotulenController::class, 'create'])->name('frame1');
Route::post('/notulen/store', [NotulenController::class, 'store'])->name('notulen.store');
Route::get('/notulen/{id}/edit',[NotulenController::class,'edit'])->name('notulen.edit');
Route::PUT('/notulen/{id}', [NotulenController::class, 'update'])->name('notulen.update');


Route::get('presence-detail/export-pdf/{id}', [PresenceDetailController::class, 'exportpdf'])->name('presence-detail.export-pdf');

Route::get('/absen/{id}', [absenController::class, 'index'])->name('absen.index');
Route::get('/absen/{id}/show', [absenController::class, 'show'])->name('absen.show');
Route::post('/absen/{id}/store', [absenController::class, 'store'])->name('absen.store');
Route::delete('/absen/{id}/destroy', [absenController::class, 'destroy'])->name('absen.destroy');

Route::get('/update', function () {
    return view('update');
});
Route::get('/deskripsi', function () {
    return view('deskripsi');
});
