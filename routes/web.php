<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VaccineController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('vaccines', VaccineController::class)->except(['show']);
    Route::resource('patients', PatientController::class);
    Route::resource('vaccination-records', App\Http\Controllers\VaccinationRecordController::class)->only(['edit', 'update', 'destroy']);
    Route::post('patients/{patient}/vaccination-records', [App\Http\Controllers\VaccinationRecordController::class, 'store'])->name('patients.vaccination-records.store');
    
    Route::get('/reports/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');
    Route::get('/reports/monthly/download', [ReportController::class, 'download'])->name('reports.download');
});
