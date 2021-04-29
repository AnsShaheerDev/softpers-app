<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;

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

Route::middleware(['auth'])->name('file.')->group(function () {
	Route::get('/upload-file',[DataController::class,'index'])->name('upload');
	Route::get('/download-file',[DataController::class,'downloadFile'])->name('download');
	Route::post('/post-file',[DataController::class,'store'])->name('store');
	Route::get('/get-data/{file_id}',[DataController::class,'getData'])->name('data');
});

require __DIR__.'/auth.php';
