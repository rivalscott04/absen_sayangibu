<?php

use App\Http\Controllers\SiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['prefix' => 'api'], function () {

//     // SISWA
//     Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
//     Route::get('/siswa/{id}', [SiswaController::class, 'get'])->name('siswa.get');
//     Route::get('/siswa/nis/{nis}', [SiswaController::class, 'getByNis'])->name('siswa.getByNis');
//     Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
//     Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
//     Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
// });
