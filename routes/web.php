<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/todo', [TodoController::class, 'index'])->name('todo.index');
Route::post('/todo', [TodoController::class, 'store'])->name('todo.store');
Route::get('/todo/{todo}/edit', [TodoController::class, 'edit'])->name('todo.edit');
Route::delete('/todo/{todo}', [TodoController::class, 'destroy'])->name('todo.destroy');
Route::put('/todo/{todo}', [TodoController::class, 'update'])->name('todo.update');
Route::get('/todo/create', [TodoController::class, 'create'])->name('todo.create');
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/verify-2fa', [TwoFactorController::class, 'index'])->name('verify.index');
    Route::post('/verify-2fa', [TwoFactorController::class, 'store'])->name('verify.store');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});



