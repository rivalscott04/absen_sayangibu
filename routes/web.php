<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MesinController;
use App\Http\Controllers\JadwalController;


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

// Page Route
// Route::get('/', [PageController::class, 'blankPage'])->middleware('verified');
Route::get('/', [PageController::class, 'dashboardModern']);

//tes login page
Route::get('/login', [LoginController::class, 'showLoginForm']);

// locale route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

Auth::routes(['verify' => true]);


//siswa
Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');

//kehadiran
Route::get('/kehadiran', [AbsenController::class, 'index'])->name('absen.index');

//mesin
Route::get('/mesin', [MesinController::class, 'index'])->name('mesin.index');
Route::post('/mesin', [MesinController::class, 'store'])->name('mesin.store');
Route::delete('/mesin/{id}', [MesinController::class, 'destroy'])->name('mesin.destroy');

//jadwal
Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');


Route::group(['prefix' => 'api', 'namespace' => 'Api'], function () {

    // SISWA
    Route::get('/siswa', 'SiswaController@index')->name('api.siswa.index');
    Route::get('/siswa/{id}', 'SiswaController@get')->name('api.siswa.get');
    Route::get('/siswa/nis/{nis}', 'SiswaController@getByNis')->name('api.siswa.getByNis');
    Route::post('/siswa', 'SiswaController@store')->name('api.siswa.store');
    Route::post('/siswa/{id}', 'SiswaController@update')->name('api.siswa.update');
    Route::delete('/siswa/{id}', 'SiswaController@destroy')->name('api.siswa.destroy');

    // ABSEN
    Route::get('/absensi', 'AbsenController@index')->name('api.absensi.index');
    Route::post('/absensi', 'AbsenController@store')->name('api.absensi.store');

    // MESIN
    Route::post('/mesin/check', 'MesinController@cekMesin')->name('api.mesin.cek');
    Route::post('/mesin', 'MesinController@store')->name('api.mesin.store');
    Route::get('/mesin', 'MesinController@index')->name('api.mesin.index');
    // Route::get('/mesin/cobalah', 'MesinController@mesinNih')->name('api.mesin.nih');

    // JADWAL
    Route::post('/jadwal', 'JadwalController@store')->name('api.jadwal.store');
    Route::get('/jadwal', 'JadwalController@index')->name('api.jadwal.index');
    Route::post('/jadwal/{id}', 'JadwalController@update')->name('api.jadwal.update');
    Route::delete('/jadwal/{id}', 'JadwalController@destroy')->name('api.jadwal.destroy');
});
