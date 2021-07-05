<?php

use App\Http\Controllers\DiaristaController;
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

Route::get('/', [DiaristaController::class, 'index'])->name('diarista.index');
Route::get('/diarista/create', [DiaristaController::class, 'create'])->name('diarista.create');
Route::get('/diarista/{id}/edit', [DiaristaController::class, 'edit'])->name('diarista.edit');
Route::post('/diaristas', [DiaristaController::class, 'store'])->name('diarista.store');
Route::put('/diaristas/{id}', [DiaristaController::class, 'update'])->name('diarista.update');
Route::get('/diaristas/{id}', [DiaristaController::class, 'destroy'])->name('diarista.destroy');

