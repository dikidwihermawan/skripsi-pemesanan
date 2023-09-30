<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'register'])->name('register');
});
Route::middleware(['checkRole:manager,admin,client'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->middleware('auth', 'checkRole:manager,admin,client')->name("dashboard");
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
Route::middleware(['checkRole:manager,client'])->group(function () {
    Route::get('/translation', [TranslationController::class, 'index'])->name('translation');
    Route::get('/translation/read', [TranslationController::class, 'read'])->name('translation.read');;
    Route::post('/translation/store', [TranslationController::class, 'store'])->name('translation.store');
    Route::get('/translation/{id}', [TranslationController::class, 'edit']);
    Route::put('/translation/update/{id}', [TranslationController::class, 'update']);
    Route::delete('/translation/destroy/{id}', [TranslationController::class, 'destroy']);
});
Route::middleware(['checkRole:manager'])->group(function () {
    Route::get('/users/{role}', [UserController::class, 'index'])->name('users');
    Route::get('/users/{role}/read', [UserController::class, 'read'])->name(('user.read'));
    Route::get('/users/{role}/view/{id}', [UserController::class, 'view'])->name(('user.view'));
    Route::put('/users/{role}/update/{id}', [UserController::class, 'update'])->name(('user.update'));
    Route::delete('/users/destroy/{id}', [UserController::class, 'destroy'])->name(('user.destroy'));
});
Route::middleware(['checkRole:manager,admin'])->group(function () {
    Route::get('/jobs/{status}', [JobController::class, 'index'])->name('jobs');
    Route::get('/jobs/{status}/read', [JobController::class, 'read'])->name('jobs.read');
    Route::get('/jobs/{status}/view/{id}', [JobController::class, 'view'])->name('jobs.view');
    Route::put('/jobs/{status}/view/{id}/update', [JobController::class, 'update'])->name('jobs.view.update');
    Route::post('/jobs/{status}/view/{id}/upload', [JobController::class, 'upload'])->name('jobs.view.upload');
});
Route::middleware(['checkRole:client'])->group(function () {
    Route::get('/dashboard/read', [OrderController::class, 'read'])->name('dashboard.read');
    Route::get('/dashboard/order/create', [OrderController::class, 'index'])->name('dashboard.order.create');
    Route::get('/dashboard/order/view/{id}', [OrderController::class, 'view'])->name('dashboard.order.view');
    Route::get('/dashboard/order/print/{id}', [OrderController::class, 'print'])->name('dashboard.order.print');
    Route::get('/dashboard/order/payment/{id}', [OrderController::class, 'payment'])->name('dashboard.order.payment');
    Route::post('/dashboard/order/payment/{id}', [OrderController::class, 'upload_payment']);
    Route::post('/dashboard/order/upload', [OrderController::class, 'upload'])->name('dashboard.order.upload');
    Route::get('/dashboard/order/total', [OrderController::class, 'total'])->name('dashboard.order.total');
    Route::delete('/dashboard/order/destroy/{id}', [OrderController::class, 'destroy']);
});
