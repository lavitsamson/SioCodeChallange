<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TimeLogController;
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
});


Route::middleware('auth')->group(function () {
    Route::get('/projects', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('project.create');
    Route::get('/projects/{id}', [ProjectController::class, 'edit'])->name('project.edit');
    Route::post('/projects', [ProjectController::class, 'store'])->name('project.store');
    Route::post('/projects/{id}', [ProjectController::class, 'update'])->name('project.update');
    Route::get('/projects/delete/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/timelog', [TimeLogController::class, 'index'])->name('timelog.index');
    Route::get('/timelog/create', [TimeLogController::class, 'create'])->name('timelog.create');
    Route::get('/timelog/{id}', [TimeLogController::class, 'edit'])->name('timelog.edit');
    Route::post('/timelog', [TimeLogController::class, 'store'])->name('timelog.store');
    Route::post('/timelog/{id}', [TimeLogController::class, 'update'])->name('timelog.update');
    Route::get('/timelog/delete/{id}', [TimeLogController::class, 'destroy'])->name('timelog.destroy');
});

require __DIR__.'/auth.php';
