<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\WebTaskController;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login.form');
});

Route::middleware(['guest',\App\Http\Middleware\NoCache::class])->group(function () {
	Route::get('/register', [WebAuthController::class, 'showRegisterForm'])->name('register.form');
	Route::post('/register', [WebAuthController::class, 'register'])->name('register');
	Route::get('/login', [WebAuthController::class, 'showLoginForm'])->name('login.form');
	Route::post('/login', [WebAuthController::class, 'login'])->name('login');

});

Route::post('/logout', [WebAuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [WebTaskController::class, 'index'])->name('dashboard');
    Route::get('/tasks/archived', [WebTaskController::class, 'archived'])->name('tasks.archived');

    Route::get('/tasks/create', [WebTaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [WebTaskController::class, 'store'])->name('tasks.store');

    Route::get('/tasks/{task}', [WebTaskController::class, 'show'])->name('tasks.show');

    Route::get('/tasks/{task}/edit', [WebTaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [WebTaskController::class, 'update'])->name('tasks.update');

    Route::delete('/tasks/{task}', [WebTaskController::class, 'destroy'])->name('tasks.destroy');


    Route::post('/tasks/{id}/restore', [WebTaskController::class, 'restore'])->name('tasks.restore');
});
