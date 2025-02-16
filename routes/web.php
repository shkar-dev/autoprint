<?php

use App\Http\Controllers\AutoPrintController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/index',  [AutoPrintController::class, 'index'])->name('index');
Route::post('uploadImage', [AutoPrintController::class, 'uploadImage'])->name('uploadImage');
//Route::post('uploadMultipleImage', [AutoPrintController::class, 'uploadMultipleImage'])->name('uploadMultipleImage');
