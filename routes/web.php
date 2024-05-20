<?php

use App\Http\Controllers\admin\OrtuController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\AntrianController;
use App\Http\Controllers\admin\BalitaController;
use App\Http\Controllers\admin\ImunisasiController;
use App\Http\Controllers\admin\VaksinController;
use App\Http\Controllers\admin\VaksinTransakiController;
use App\Http\Controllers\admin\VitaminTransaksiController;
use App\Http\Controllers\admin\VitaminController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\KegiatanController;
use App\Http\Controllers\admin\KaderController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\ExportController;
use App\Http\Controllers\admin\LaporanController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\TempImagesController;

use App\Http\Controllers\frontend\FrontController;

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

// Route::get('/', [FrontController::class, 'index']);
Route::get('/', [FrontController::class, 'index'])->name('welcome');
Route::get('/balita', [FrontController::class, 'showBalita'])->name('balita.show');
Route::get('/imunisasi/{id}', [FrontController::class, 'showImunisasi'])->name('imunisasi.show');
Route::post('/count-antrian', [AntrianController::class, 'countAntrian'])->name('countAntrian');

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [HomeController::class, 'logout'])->name('admin.logout');

        // App
        Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings');
        Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');

        // Antrian
        Route::get('/antrian', [AntrianController::class, 'index'])->name('antrian.index');
        Route::get('/antrian/clear', [AntrianController::class, 'clear'])->name('antrian.clear');
        Route::get('/status/{id}', [AntrianController::class, 'changeStatus'])->name('ubah.status');

        // Ortu
        Route::get('/orang-tua', [OrtuController::class, 'index'])->name('orang-tua.index');
        Route::get('/orang-tua/create', [OrtuController::class, 'create'])->name('orang-tua.create');
        Route::post('/orang-tua/store', [OrtuController::class, 'store'])->name('orang-tua.store');
        Route::post('/check-existing-data', [OrtuController::class, 'checkExistingData'])->name('check-existing-data');
        Route::get('/orang-tua/edit/{id}', [OrtuController::class, 'edit'])->name('orang-tua.edit');
        Route::put('/orang-tua/{id}', [OrtuController::class, 'update'])->name('orang-tua.update');
        Route::get('get-balita/{id}', [OrtuController::class, 'getBalita'])->name('get-balita.show');
        Route::delete('/orang-tua/{id}', [OrtuController::class, 'destroy'])->name('orang-tua.delete');

        // Balita
        Route::get('/balita', [BalitaController::class, 'index'])->name('balita.index');
        Route::get('/balita/create', [BalitaController::class, 'create'])->name('balita.create');
        Route::post('/balita', [BalitaController::class, 'store'])->name('balita.store');
        Route::get('/balita/{balita}/edit', [BalitaController::class, 'edit'])->name('balita.edit');
        Route::put('/balita/{balita}', [BalitaController::class, 'update'])->name('balita.update');
        Route::delete('/balita/balita/{balita}', [BalitaController::class, 'destroy'])->name('balita.delete');


        // Imunisasi
        Route::get('/imunisasi/{id}', [ImunisasiController::class, 'index'])->name('imunisasi.index');
        Route::get('/imunisasi/create/{id}', [ImunisasiController::class, 'create'])->name('imunisasi.create');
        Route::post('/imunisasi', [ImunisasiController::class, 'store'])->name('imunisasi.store');
        Route::get('/imunisasi/edit/{id}', [ImunisasiController::class, 'edit'])->name('imunisasi.edit');
        Route::post('/imunisasi/update/{id}', [ImunisasiController::class, 'update'])->name('imunisasi.update');

        // Vaksin
        Route::get('/vaksin', [VaksinController::class, 'index'])->name('vaksin.index');
        Route::post('/vaksin', [VaksinController::class, 'store'])->name('vaksin.store');
        Route::get('/vaksin/{id}', [VaksinController::class, 'show'])->name('vaksin.show');
        Route::put('/vaksin/{id}', [VaksinController::class, 'update'])->name('vaksin.update');
        Route::delete('/vaksin/{id}', [VaksinController::class, 'destroy'])->name('vaksin.delete');

        // Vaksin Transaksi
        Route::get('/vaksin-transaksi', [VaksinTransakiController::class, 'index'])->name('vaksin-transaksi.index');
        Route::post('/vaksin-transaksi/masuk', [VaksinTransakiController::class, 'createMasuk'])->name('vaksin-transaksi.store-masuk');
        Route::post('/vaksin-transaksi/keluar', [VaksinTransakiController::class, 'createKeluar'])->name('vaksin-transaksi.store-keluar');
        Route::post('/check-stock-vaksin', [VaksinTransakiController::class, 'checkStock'])->name('check-stock-vaksin');
        Route::delete('/vaksin-transaksi/masuk/{id}', [VaksinTransakiController::class, 'destroyMasuk'])->name('vaksin-transaksi.delete-masuk');
        Route::delete('/vaksin-transaksi/keluar/{id}', [VaksinTransakiController::class, 'destroyKeluar'])->name('vaksin-transaksi.delete-keluar');

        // Vitamin
        Route::get('/vitamin', [VitaminController::class, 'index'])->name('vitamin.index');
        Route::post('/vitamin', [VitaminController::class, 'store'])->name('vitamin.store');
        Route::get('/vitamin/{id}', [VitaminController::class, 'show'])->name('vitamin.show');
        Route::put('/vitamin/{id}', [VitaminController::class, 'update'])->name('vitamin.update');
        Route::delete('/vitamin/{id}', [VitaminController::class, 'destroy'])->name('vitamin.delete');

        // Vitamin Transaksi
        Route::get('/vitamin-transaksi', [VitaminTransaksiController::class, 'index'])->name('vitamin-transaksi.index');
        Route::post('/vitamin-transaksi/masuk', [VitaminTransaksiController::class, 'createMasuk'])->name('vitamin-transaksi.store-masuk');
        Route::post('/vitamin-transaksi/keluar', [VitaminTransaksiController::class, 'createKeluar'])->name('vitamin-transaksi.store-keluar');
        Route::post('/check-stock-vitamin', [VitaminTransaksiController::class, 'checkStock'])->name('check-stock-vitamin');
        Route::delete('/vitamin-transaksi/masuk/{id}', [VitaminTransaksiController::class, 'destroyMasuk'])->name('vitamin-transaksi.delete-masuk');
        Route::delete('/vitamin-transaksi/keluar/{id}', [VitaminTransaksiController::class, 'destroyKeluar'])->name('vitamin-transaksi.delete-keluar');

        // Kegiatan
        Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
        Route::get('/kegiatan/create', [KegiatanController::class, 'create'])->name('kegiatan.create');
        Route::post('/kegiatan', [KegiatanController::class, 'store'])->name('kegiatan.store');
        Route::get('/kegiatan/{id}/edit', [KegiatanController::class, 'edit'])->name('kegiatan.edit');
        Route::put('/kegiatan/{id}', [KegiatanController::class, 'update'])->name('kegiatan.update');
        Route::delete('/kegiatan/{id}', [kegiatanController::class, 'destroy'])->name('kegiatan.delete');

        // Temp Images
        Route::post('/upload-temp-image', [TempImagesController::class, 'create'])->name('temp-images.create');

        // Kader
        Route::get('/kader', [KaderController::class, 'index'])->name('kader.index');
        Route::get('/kader/create', [KaderController::class, 'create'])->name('kader.create');
        Route::post('/kader', [KaderController::class, 'store'])->name('kader.store');
        Route::get('/kader/{id}/edit', [KaderController::class, 'edit'])->name('kader.edit');
        Route::put('/kader/{id}', [KaderController::class, 'update'])->name('kader.update');
        Route::delete('/kader/{id}', [KaderController::class, 'destroy'])->name('kader.delete');

        // User
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::post('/user', [UserController::class, 'store'])->name('user.store');
        Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
        Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.delete');

        // Export
        Route::get('balita/export_excel', [ExportController::class, 'export_balita']);
        Route::get('vaksin/export_excel', [ExportController::class, 'export_vaksin']);
        Route::get('jadwal/export_excel', [ExportController::class, 'export_jadwal']);
        Route::get('/export_imunisasi/{id_balita}', [ExportController::class, 'export_imunisasi'])->name('export-imunisasi');

        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/download', [LaporanController::class, 'download'])->name('laporan.download');
        Route::get('/laporan/word', [LaporanController::class, 'word'])->name('laporan.word');
        Route::get('/laporan/jadwal', [LaporanController::class, 'jadwal'])->name('laporan.jadwal');
    });
});
