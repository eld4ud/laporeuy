<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TechnicianController;

Route::get('/', [ReportController::class, 'landing'])->name('home');
Route::get('/login', fn () => view('auth.login', ['portal' => 'pelapor']))->name('login');
Route::get('/register', fn () => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/admin/login', fn () => view('auth.login', ['portal' => 'admin']))->name('admin.login');
Route::get('/teknisi/login', fn () => view('auth.login', ['portal' => 'teknisi']))->name('technician.login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ReportController::class, 'dashboard'])->name('dashboard');
    Route::get('/laporan/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/laporan', [ReportController::class, 'store'])->name('reports.store');
    Route::get('/laporan/{report}', [ReportController::class, 'show'])->name('reports.show');
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::patch('/laporan/{report}/verifikasi', [AdminController::class, 'verify'])->name('reports.verify');
        Route::patch('/laporan/{report}/assign', [AdminController::class, 'assign'])->name('reports.assign');
        Route::patch('/laporan/{report}/approve', [AdminController::class, 'approve'])->name('reports.approve');
        Route::patch('/laporan/{report}/reject', [AdminController::class, 'reject'])->name('reports.reject');
        Route::get('/teknisi/create', [AdminController::class, 'createTechnician'])->name('technicians.create');
        Route::post('/teknisi', [AdminController::class, 'storeTechnician'])->name('technicians.store');
    });
    Route::prefix('teknisi')->name('technician.')->group(function () {
        Route::get('/dashboard', [TechnicianController::class, 'index'])->name('dashboard');
        Route::patch('/laporan/{report}/status', [TechnicianController::class, 'updateStatus'])->name('reports.status');
    });
});
