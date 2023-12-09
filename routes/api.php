<?php

use App\Http\Controllers\API\PemilikController;
use App\Http\Controllers\API\PenyewaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register/pemilik', [PemilikController::class, 'register']);
Route::post('login/pemilik', [PemilikController::class, 'loginPemilik']);

Route::post('register/penyewa', [PenyewaController::class, 'register']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});