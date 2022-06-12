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
    Route::get('user-tambah', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
    Route::post('user-tambah', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
    Route::get('user/{user}/detail', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');
    Route::get('user/{user}/ubah', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
    Route::post('user/{user}/ubah', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    Route::post('user/{user}/hapus', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
});
