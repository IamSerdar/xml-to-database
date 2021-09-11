<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\XmlController;

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

Route::get('file-upload', [XmlController::class, 'fileUpload'])->name('file.upload');
Route::post('file-upload', [XmlController::class, 'fileUploadPost'])->name('file.upload.post');

