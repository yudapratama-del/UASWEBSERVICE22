<?php

use App\Http\Controllers\API\AbsenController;
use App\Http\Controllers\API\GajiController;
use App\Http\Controllers\API\JenisPegawaiController;
use App\Http\Controllers\API\LemburController;
use App\Http\Controllers\API\PegawaiController;
use App\Http\Controllers\Auth\AuthController;
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

    Route::get('password', function (){
        return bcrypt('yuda');
    });

    //table pegawai
    Route::get('pegawais', [PegawaiController::class, 'index']);
    Route::get('pegawai/{nip}', [PegawaiController::class, 'show']);
    Route::post('pegawai', [PegawaiController::class, 'store']);
    Route::put('pegawai/{nip}', [PegawaiController::class, 'update']);
    Route::delete('pegawai/{nip}', [PegawaiController::class, 'destroy']);
    // tes relasi antar tabel
    Route::get('pegawaiR', [PegawaiController::class, 'indexRelasi']);

    //table jenis_pegawai
    Route::get('jenis_pegawais', [JenisPegawaiController::class, 'index']);
    Route::get('jenis_pegawai/{id_jenis}', [JenisPegawaiController::class, 'show']);
    Route::post('jenis_pegawai', [JenisPegawaiController::class, 'store']);
    Route::put('jenis_pegawai/{id_jenis}', [JenisPegawaiController::class, 'update']);
    Route::delete('jenis_pegawai/{id_jenis}', [JenisPegawaiController::class, 'destroy']);
    // tes relasi antar tabel
    Route::get('jenis_pegawaiR', [JenisPegawaiController::class, 'indexRelasi']);

    //table absen
    Route::get('absens', [AbsenController::class, 'index']);
    Route::get('absen/{id_absen}', [AbsenController::class, 'show']);
    Route::post('absen', [AbsenController::class, 'store']);
    Route::put('absen/{id_absen}', [AbsenController::class, 'update']);
    Route::delete('absen/{id_absen}', [AbsenController::class, 'destroy']);
    // tes relasi antar tabel
    Route::get('absenR', [AbsenController::class, 'indexRelasi']);

    //table lembur
    Route::get('lemburs', [LemburController::class, 'index']);
    Route::get('lembur/{id_lembur}', [LemburController::class, 'show']);
    Route::post('lembur', [LemburController::class, 'store']);
    Route::put('lembur/{id_lembur}', [LemburController::class, 'update']);
    Route::delete('lembur/{id_lembur}', [LemburController::class, 'destroy']);
    // tes relasi antar tabel
    Route::get('lemburR', [LemburController::class, 'indexRelasi']);

    //table gaji
    Route::get('gajis', [GajiController::class, 'index']);
    Route::get('gaji/{id_gaji}', [GajiController::class, 'show']);
    Route::post('gaji', [GajiController::class, 'store']);
    Route::put('gaji/{id_gaji}', [GajiController::class, 'update']);
    Route::delete('gaji/{id_gaji}', [GajiController::class, 'destroy']);
    // tes relasi antar tabel
    Route::get('gajiR', [GajiController::class, 'indexRelasi']);
    

    // route jwt auth
    Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {

        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);
    });

