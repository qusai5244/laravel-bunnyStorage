<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\HelloWorldController;

Route::get('/upload', [HelloWorldController::class, 'uploadFile']);
Route::get('/delete', [HelloWorldController::class, 'deleteFile']);
Route::get('/download', [HelloWorldController::class, 'downloadFile']);
Route::get('/list', [HelloWorldController::class, 'listFiles']);
Route::get('/fileInfo', [HelloWorldController::class, 'getFileDetails']);
