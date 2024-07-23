<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RequestController;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('guest')->group(function () {
    Route::get('/login/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('/login/google/callback', [AuthController::class, 'handleGoogleCallback']);
});

// Admin dashboard
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::prefix('admin/users')->group(function () {
        Route::get('', [UserController::class, 'index'])->name('users');
        Route::get('create', [UserController::class, 'create'])->name('users.create');
        Route::post('store', [UserController::class, 'store'])->name('users.store');
        Route::get('show/{id}', [UserController::class, 'show'])->name('users.show');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::put('edit/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');    
    });
    Route::prefix('admin/requests')->group(function () {
        Route::get('', [RequestController::class, 'index'])->name('admin.requests');
        Route::get('pending', [RequestController::class, 'index_p'])->name('requests.pending');
        Route::get('approved', [RequestController::class, 'index_a'])->name('requests.approved');
        Route::get('rejected', [RequestController::class, 'index_d'])->name('requests.rejected');
        Route::get('show/{id}', [RequestController::class, 'show'])->name('admin.request.show');
        Route::post('{id}/approve', [RequestController::class, 'approveRequest'])->name('admin.requests.approve');
        Route::post('{id}/decline', [RequestController::class, 'declineRequest'])->name('admin.requests.decline');
        Route::delete('destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');    
    });
   
});

// User dashboard
Route::middleware(['auth', 'verified', 'user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::prefix('request')->group(function () {
        Route::get('create', [RequestController::class, 'create'])->name('request.create');
        Route::get('', [RequestController::class, 'index'])->name('requests');
        Route::post('store', [RequestController::class, 'store'])->name('request.store');
        Route::get('show/{id}', [RequestController::class, 'show'])->name('request.show');
        Route::get('edit/{id}', [RequestController::class, 'edit'])->name('request.edit');
        Route::put('edit/{id}', [RequestController::class, 'update'])->name('request.update');    
    });
});






