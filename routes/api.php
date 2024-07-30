<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LigaController;
use App\Http\Controllers\Api\FanController;
use App\Http\Controllers\Api\KlubController;
use App\Http\Controllers\Api\PemainController;
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
// Liga
// Route::get('liga', [LigaController::class, 'index']);
// Route::post('liga', [LigaController::class, 'store']);
// Route::get('liga/{id}', [LigaController::class, 'show']);
// Route::put('liga/{id}', [LigaController::class, 'update']);
// Route::delete('liga/{id}', [LigaController::class, 'destroy']);
Route::resource('liga', LigaController::class)->except(['edit','create']);
// Fan
// Route::get('fan', [FanController::class, 'index']);
// Route::post('fan', [FanController::class, 'store']);
// Route::get('fan/{id}', [FanController::class, 'show']);
// Route::put('fan/{id}', [FanController::class, 'update']);
// Route::delete('fan/{id}', [FanController::class, 'destroy']);
Route::resource('fan', FanController::class)->except(['edit','create']);
Route::resource('klub', KlubController::class)->except(['edit','create']);
Route::resource('pemain', PemainController::class)->except(['edit','create']);