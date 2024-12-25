<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\TransactionController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/wisata', [LandingController::class, 'wisata'])->name('wisata');
Route::get('/wisata/{uuid}', [LandingController::class, 'detail'])->name('detail.wisata');
Route::post('/wisata/pembayaran/{uuid}', [LandingController::class, 'simpan_pembayaran'])->name('simpan.pembayaran');
Route::get('/wisata/pembayaran/{uuid}', [LandingController::class, 'pembayaran'])->name('pembayaran.wisata');
Route::put('/wisata/pembayaran/konfirmasi/{uuid}', [LandingController::class, 'konfirmasi_pembayaran'])->name('konfirmasi.pembayaran');
Route::get('/augmented_reality/{uuid}', [LandingController::class, 'augmented'])->name('ar');
Route::get('/wisata', [LandingController::class, 'search'])->name('search');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('dashboard/users', UserController::class);
    Route::resource('dashboard/categories', CategoryController::class);
    Route::resource('dashboard/wisata', WisataController::class);
    Route::resource('dashboard/transactions', TransactionController::class);
});
