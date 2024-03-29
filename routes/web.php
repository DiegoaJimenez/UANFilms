<?php

use App\Http\Controllers\MoviesController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/show', function () {
    return view('show');
})->middleware(['auth', 'verified'])->name('show');

Route::get('/dashboard',[MoviesController::class, 'index'])->middleware(['auth', 'verified'])->name('movies.index');
Route::get('/movies/{movies}',[MoviesController::class, 'show'])->middleware(['auth', 'verified'])->name('movies.show');
Route::match(['get', 'post'], '/reseña', [App\Http\Controllers\ReseñasController::class, 'message'])->name('message');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
