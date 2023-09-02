<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PeminjamanAlatCotroller;
use App\Http\Controllers\Api\PeminjamanLabController;
use App\Http\Controllers\Api\PengajuanFormController;
use App\Http\Controllers\Api\UtilController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post( '/login', [AuthController::class, 'login']);
Route::get('/util-getbarang', [UtilController::class, 'GetBarang']);
Route::get('/util-getlab', [UtilController::class, 'GetLab']);


Route::get( '/barang', [PeminjamanAlatCotroller::class, 'index']);
Route::get('/lab', [PeminjamanLabController:: class, 'index']);
Route::get('/pengajuan-form', [PengajuanFormController::class, 'index']);
Route::group(['middleware' => ['auth:sanctum']],function(){
    Route::post( '/logout', [AuthController::class, 'logout']);
    Route::post('/barang/save', [PeminjamanAlatCotroller::class, 'store']);
    Route::post('/lab/save', [PeminjamanLabController::class, 'store']);
    Route::post('/form/save', [PengajuanFormController::class, 'store']);
});