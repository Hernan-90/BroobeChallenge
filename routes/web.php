<?php

use App\Http\Controllers\MetricController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MetricController::class, 'index'])->name('home');
Route::post('/', [MetricController::class, 'requestMetrics'])->name('show');
Route::post('/store', [MetricController::class, 'storeMetrics'])->name('store');
Route::get('/history', [MetricController::class, 'showHistory'])->name('history');

