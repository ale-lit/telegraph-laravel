<?php

use App\Http\Controllers\TextController;
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

Route::get('/', [TextController::class, 'create'])->name('text.create');
Route::post('/', [TextController::class, 'store'])->name('text.store');
Route::get('/{slug}', [TextController::class, 'show'])->name('text.show');
Route::get('/edit/{slug}', [TextController::class, 'edit'])->name('text.edit');
Route::put('/{slug}', [TextController::class, 'update'])->name('text.update');
Route::delete('/{slug}', [TextController::class, 'destroy'])->name('text.destroy');
