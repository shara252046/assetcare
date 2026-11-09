<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\PublicReportController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// Public (without Login): QR Scan, Issue Report
Route::get('/report/{code}', [PublicReportController::class, 'show'])
    ->where('code', '[A-Z]{2}-[0-9]{2,4}')->name('report.show');
Route::post('/report/{code}', [PublicReportController::class, 'store'])
    ->where('code', '[A-Z]{2}-[0-9]{2,4}')->middleware('throttle:5,1')->name('report.store');

// Admin (Basic Login)
Route::middleware('admin')->group(function () {
    Route::get('/', [AssetController::class, 'index'])->name('admin.home');
    Route::post('/assets', [AssetController::class, 'store'])->name('assets.store');
    Route::get('/assets/{asset:code}/qr', [AssetController::class, 'qr'])->name('assets.qr');
    Route::patch('/tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');
});