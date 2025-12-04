<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/contact', ContractController::class);//resource сам сопоставляет методы

    Route::resource('/deal', \App\Http\Controllers\DealController::class);

    Route::resource('/activity', \App\Http\Controllers\ActivityController::class)
        ->only(['store','edit','update','destroy']);

    Route::resource('/task', \App\Http\Controllers\TaskController::class)
        ->only(['update','store','destroy','edit','index']);
});

require __DIR__.'/auth.php';
