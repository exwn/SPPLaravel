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
    return view('auth.login');
});

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

    //Manajemen Pelajar
    Route::get('pelajar', [App\Http\Controllers\PelajarController::class, 'index'])->name('pelajar.index');
    Route::get('tambah-pelajar', [App\Http\Controllers\PelajarController::class, 'create'])->name('pelajar.create');
    Route::post('tambah-pelajar', [App\Http\Controllers\PelajarController::class, 'store'])->name('pelajar.store');
    Route::get('pelajar/{pelajar}/detail', [App\Http\Controllers\PelajarController::class, 'show'])->name('pelajar.show');
    Route::get('pelajar/{pelajar}/ubah', [App\Http\Controllers\PelajarController::class, 'edit'])->name('pelajar.edit');
    Route::post('pelajar/{pelajar}/ubah', [App\Http\Controllers\PelajarController::class, 'update'])->name('pelajar.update');
    Route::post('pelajar/{pelajar}/hapus', [App\Http\Controllers\PelajarController::class, 'destroy'])->name('pelajar.destroy');

    //Manajemen Spp
    Route::get('spp', [App\Http\Controllers\SppController::class, 'index'])->name('spp.index');
    Route::get('tambah-spp', [App\Http\Controllers\SppController::class, 'create'])->name('spp.create');
    Route::post('tambah-spp', [App\Http\Controllers\SppController::class, 'store'])->name('spp.store');
    Route::get('spp/{spp}/ubah', [App\Http\Controllers\SppController::class, 'edit'])->name('spp.edit');
    Route::post('spp/{spp}/ubah', [App\Http\Controllers\SppController::class, 'update'])->name('spp.update');
    Route::post('spp/{spp}/hapus', [App\Http\Controllers\SppController::class, 'destroy'])->name('spp.destroy');

    // Manajemen Transaksi
    Route::get('transaksi', [App\Http\Controllers\TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('tambah-transaksi', [App\Http\Controllers\TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('tambah-transaksi', [App\Http\Controllers\TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('transaksi/{transaksi}/ubah', [App\Http\Controllers\TransaksiController::class, 'edit'])->name('transaksi.edit');
    Route::post('transaksi/{transaksi}/ubah', [App\Http\Controllers\TransaksiController::class, 'update'])->name('transaksi.update');
    Route::post('transaksi/{transaksi}/hapus', [App\Http\Controllers\TransaksiController::class, 'destroy'])->name('transaksi.destroy');
});

Route::group(['middleware' => ['auth:sanctum', 'verified', 'role:Admin']], function () {

    //Manajemen User
    Route::get('user', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::get('tambah-user', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
    Route::post('tambah-user', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
    Route::get('user/{user}/detail', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');
    Route::get('user/{user}/ubah', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
    Route::post('user/{user}/ubah', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    Route::post('user/{user}/hapus', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');

    //Manajemen Jurusan
    Route::get('jurusan', [App\Http\Controllers\JurusanController::class, 'index'])->name('jurusan.index');
    Route::get('tambah-jurusan', [App\Http\Controllers\JurusanController::class, 'create'])->name('jurusan.create');
    Route::post('tambah-jurusan', [App\Http\Controllers\JurusanController::class, 'store'])->name('jurusan.store');
    Route::get('jurusan/{jurusan}/detail', [App\Http\Controllers\JurusanController::class, 'show'])->name('jurusan.show');
    Route::get('jurusan/{jurusan}/ubah', [App\Http\Controllers\JurusanController::class, 'edit'])->name('jurusan.edit');
    Route::post('jurusan/{jurusan}/ubah', [App\Http\Controllers\JurusanController::class, 'update'])->name('jurusan.update');
    Route::post('jurusan/{jurusan}/hapus', [App\Http\Controllers\JurusanController::class, 'destroy'])->name('jurusan.destroy');
});
