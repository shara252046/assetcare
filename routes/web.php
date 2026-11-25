<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\PublicReportController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\WarrantyController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\AssetHistoryController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// ==========================================
// 1. PUBLIC ROUTES (Login chara access kora jabe)
// ==========================================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/report/{code}', [PublicReportController::class, 'show'])
    ->where('code', '[A-Z]{2}-[0-9]{2,4}')->name('report.show');
Route::post('/report/{code}', [PublicReportController::class, 'store'])
    ->where('code', '[A-Z]{2}-[0-9]{2,4}')->middleware('throttle:5,1')->name('report.store');


// ==========================================
// 2. PROTECTED ROUTES (Login korte hobe)
// ==========================================
Route::middleware('auth')->group(function () {
    
    // Dashboard & Assets
    Route::get('/', [AssetController::class, 'index'])->name('admin.home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/assets', [AssetController::class, 'store'])->name('assets.store');
    Route::get('/assets/{asset:code}/qr', [AssetController::class, 'qr'])->name('assets.qr');
    Route::patch('/assets/{asset:code}', [AssetController::class, 'update'])->name('assets.update');
    Route::delete('/assets/{asset:code}', [AssetController::class, 'destroy'])->name('assets.destroy');
    
    // Asset History
    Route::get('/assets/{asset:code}/history', [AssetHistoryController::class, 'show'])->name('assets.history');

    // Tickets
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::patch('/tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');

    // Maintenance Schedule
    Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');
    Route::patch('/maintenance/{asset:code}', [MaintenanceController::class, 'update'])->name('maintenance.update');
    Route::post('/maintenance/run', [MaintenanceController::class, 'run'])->name('maintenance.run');

    // Warranty
    Route::get('/warranty', [WarrantyController::class, 'index'])->name('warranty.index');

    // Technicians
    Route::get('/technicians', [TechnicianController::class, 'index'])->name('technicians.index');
    Route::post('/technicians', [TechnicianController::class, 'store'])->name('technicians.store');
    Route::delete('/technicians/{technician}', [TechnicianController::class, 'destroy'])->name('technicians.destroy');
});