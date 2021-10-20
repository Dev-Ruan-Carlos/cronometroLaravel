<?php

use App\Http\Controllers\GravarTimeController;
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

Route::prefix('gravar')->group(function() {
    Route::get('/', [GravarTimeController::class, 'index'])->name('welcome');
    Route::post('gravar', [GravarTimeController::class, 'gravar'])->name('gravar');
});