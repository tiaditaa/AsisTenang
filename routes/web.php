<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\AsistenController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'dashboard/admin'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [HomeController::class, 'profile'])->name('profile');
        Route::post('update', [HomeController::class, 'updateprofile'])->name('profile.update');
    });

    // Akun Controller Routes
    Route::controller(AkunController::class)
        ->prefix('akun')
        ->as('akun.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('showdata', 'dataTable')->name('dataTable');
            Route::match(['get','post'],'tambah', 'tambahAkun')->name('add');
            Route::match(['get','post'],'{id}/ubah', 'ubahAkun')->name('edit');
            Route::delete('{id}/hapus', 'hapusAkun')->name('delete');
        });

    // Asisten Controller Routes
    Route::prefix('asisten')
    ->as('asisten.')
    ->group(function () {
            Route::get('show', [AsistenController::class, 'show'])->name('getAsisten');
            Route::post('show', [AsistenController::class, 'getAsisten']);
            Route::get('pilih', [AsistenController::class, 'pilih'])->name('pilihAsisten');
            Route::post('pilih', [AsistenController::class, 'getAsisten']);
            Route::match(['get', 'post'], 'tambah', [AsistenController::class, 'store'])->name('add');
            Route::match(['get','post'], 'ubah/{id}', 'ubahAsisten')->name('edit');
            Route::delete('hapus/{id}', [AsistenController::class, 'hapusAsisten'])->name('delete');
            Route::get('downloadpdf', [AsistenController::class, 'downloadPDF'])->name('downloadPdf');
    });

    // Alamat Controller Routes
    Route::controller(AlamatController::class)
        ->prefix('alamat')
        ->as('alamat.')
        ->group(function () {
            Route::get('show', [AlamatController::class, 'show'])->name('getAlamat');
            Route::post('show', [AlamatController::class, 'getAlamat']);
            Route::delete('hapus/{id}', [AlamatController::class, 'hapusAlamat'])->name('delete');
            Route::match(['get', 'post'], 'tambah', 'store')->name('add');
            Route::match(['get', 'post'], 'ubah/{id}', 'ubahAlamat')->name('edit');
            Route::get('export_excel', 'exportExcel');
    });
});