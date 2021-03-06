<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\MultipleFileUploadController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/file',FileController::class);
Route::delete('/file/{id}',[FileController::class,'destroy']);
Route::get('/file/download/{id}',[FileController::class,'show']);
Route::get('/file/email/{id}',[FileController::class,'edit']);

Route::resource('/multiple',MultipleFileUploadController::class);
Route::delete('/multiple/{id}',[MultipleFileUploadController::class,'destroy']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
