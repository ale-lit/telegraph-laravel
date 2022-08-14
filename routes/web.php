<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
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

// Route::get('/aregister', [AuthController::class, 'create']); // Раскоментировать для регистрации нового админа, потом опять закомментировать
Route::post('/aregister', [AuthController::class, 'store']);
Route::get('/alogin', [AuthController::class, 'login'])->name('auth.login');
Route::post('/alogin', [AuthController::class, 'auth']);
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('auth');

Route::get('/', [TextController::class, 'create'])->name('text.create');
Route::post('/', [TextController::class, 'store'])->name('text.store');
Route::get('/{text}', [TextController::class, 'show'])->name('text.show');
Route::get('/edit/{text}', [TextController::class, 'edit'])->name('text.edit');
Route::put('/{text}', [TextController::class, 'update'])->name('text.update');
Route::delete('/{text}', [TextController::class, 'destroy'])->name('text.destroy');
