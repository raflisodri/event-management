<?php

use App\Http\Controllers\acaraController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\eventController;
use App\Http\Controllers\karyawanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaterkitController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\partisipanController;
use App\Http\Controllers\ruangController;
use App\Http\Controllers\unitBisnisController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [loginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/home', [dashboardController::class, 'index'])->name('index');
// Route Components

//event
Route::prefix('event')->name('event.')->group(function () {
    Route::get('/index', [acaraController::class, 'index'])->name('index');
    Route::get('/create', [acaraController::class, 'create'])->name('tambah');
    Route::post('/store', [acaraController::class, 'store'])->name('store');
    Route::get('/detail/{id}', [acaraController::class, 'detail'])->name('detail');
    Route::get('/mydetail/{id}', [acaraController::class, 'mydetail'])->name('mydetail');
    Route::get('/myevent', [AcaraController::class, 'myevent'])->name('myevents');
    Route::get('/tambahparti', [AcaraController::class, 'tambahparti'])->name('tambahparti');
});
Route::prefix('event/partisipan')->name('event.partisipan.')->group(function () {
    Route::post('/tambah', [PartisipanController::class, 'tambahPartisipan'])->name('tambah');
    Route::delete('/hapus', [PartisipanController::class, 'hapusPartisipan'])->name('hapus');
    Route::post('/simpan-partisipan', [PartisipanController::class, 'store'])->name('store');
});

//karyawan
Route::prefix('karyawan')->name('karyawan.')->group(function () {
    Route::get('/index', [karyawanController::class, 'index'])->name('index');
    Route::get('/create', [karyawanController::class, 'create'])->name('tambah');
    Route::post('/store', [karyawanController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [karyawanController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [karyawanController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [karyawanController::class, 'destroy'])->name('destroy');
});

//ruang
Route::prefix('ruang')->name('ruang.')->group(function () {
    Route::get('index', [ruangController::class, 'index'])->name('index');
    Route::post('/ruang', [ruangController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ruangController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [ruangController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [ruangController::class, 'destroy'])->name('destroy');
    Route::get('/off/{id}', [ruangController::class, 'off'])->name('off');
    Route::get('/on/{id}', [ruangController::class, 'on'])->name('on');
});

//Unit
Route::prefix('unit')->name('unit.')->group(function () {
    Route::get('index', [unitBisnisController::class, 'index'])->name('index');
    Route::post('/store', [unitBisnisController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [unitBisnisController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [unitBisnisController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [unitBisnisController::class, 'destroy'])->name('destroy');
    Route::get('/off/{id}', [unitBisnisController::class, 'off'])->name('off');
    Route::get('/on/{id}', [unitBisnisController::class, 'on'])->name('on');
});


