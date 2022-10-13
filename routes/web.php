<?php

use App\Http\Controllers\RoomController;
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

Route::get('file',[RoomController::class, 'create'])->name('room.create');
Route::post('file/downloadFile', [RoomController::class, 'downloadFile'])->name('room.download');
Route::get('room', [RoomController::class, 'store'])->name('room.store');
Route::post('room/algorithm', [RoomController::class, 'algorithm'])->name('room.algorithm');


