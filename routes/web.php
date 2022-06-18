<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {



    //Manajemen User
    Route::get('user', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::get('tambah-user', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
    Route::post('tambah-user', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
    Route::get('user/{user}/detail', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');
    Route::get('user/{user}/ubah', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
    Route::post('user/{user}/ubah', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    Route::post('user/{user}/hapus', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');

    //Manajemen Kelas
    Route::get('kelas', [App\Http\Controllers\KelasController::class, 'index'])->name('kelas.index');
    Route::get('tambah-kelas', [App\Http\Controllers\KelasController::class, 'create'])->name('kelas.create');
    Route::post('tambah-kelas', [App\Http\Controllers\KelasController::class, 'store'])->name('kelas.store');
    Route::get('kelas/{kelas}/ubah', [App\Http\Controllers\KelasController::class, 'edit'])->name('kelas.edit');
    Route::post('kelas/{kelas}/ubah', [App\Http\Controllers\KelasController::class, 'update'])->name('kelas.update');
    Route::post('kelas/{kelas}/hapus', [App\Http\Controllers\KelasController::class, 'destroy'])->name('kelas.destroy');

    //Manajemen Periode
    Route::get('periode', [App\Http\Controllers\PeriodeController::class, 'index'])->name('periode.index');
    Route::get('tambah-periode', [App\Http\Controllers\PeriodeController::class, 'create'])->name('periode.create');
    Route::post('tambah-periode', [App\Http\Controllers\PeriodeController::class, 'store'])->name('periode.store');
    Route::get('periode/{periode}/ubah', [App\Http\Controllers\PeriodeController::class, 'edit'])->name('periode.edit');
    Route::post('periode/{periode}/ubah', [App\Http\Controllers\PeriodeController::class, 'update'])->name('periode.update');
    Route::post('periode/{periode}/hapus', [App\Http\Controllers\PeriodeController::class, 'destroy'])->name('periode.destroy');

    //Manajemen Spp
    Route::get('spp', [App\Http\Controllers\SppController::class, 'index'])->name('spp.index');
    Route::get('tambah-spp', [App\Http\Controllers\SppController::class, 'create'])->name('spp.create');
    Route::post('tambah-spp', [App\Http\Controllers\SppController::class, 'store'])->name('spp.store');
    Route::get('spp/{spp}/ubah', [App\Http\Controllers\SppController::class, 'edit'])->name('spp.edit');
    Route::post('spp/{spp}/ubah', [App\Http\Controllers\SppController::class, 'update'])->name('spp.update');
    Route::post('spp/{spp}/hapus', [App\Http\Controllers\SppController::class, 'destroy'])->name('spp.destroy');

    //Manajemen Transaksi
    Route::get('transaksi', [App\Http\Controllers\TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('tambah-transaksi', [App\Http\Controllers\TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('tambah-transaksi', [App\Http\Controllers\TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('transaksi/{transaksi}/ubah', [App\Http\Controllers\TransaksiController::class, 'edit'])->name('transaksi.edit');
    Route::post('transaksi/{transaksi}/ubah', [App\Http\Controllers\TransaksiController::class, 'update'])->name('transaksi.update');
    Route::post('transaksi/{transaksi}/hapus', [App\Http\Controllers\TransaksiController::class, 'destroy'])->name('transaksi.destroy');
});
