<?php

use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\transaksi_pinjamb;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;

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
    return redirect()->action([HomeController::class, 'index']);
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
Route::get('/pinjam', [transaksi_pinjamb::class, 'index'])->name('pinjam.index');

// Route::get('/user.get_data',[UserController::class, 'get_data'])->name('get_data');

Route::resource('users', UsersController::class);
Route::resource('bukus', BukuController::class);
Route::resource('control_pinjam', transaksi_pinjamb::class);
