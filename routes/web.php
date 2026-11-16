<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\PublicReportController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\WarrantyController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\DashboardController;
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
    
//Maintenance Schedule + Auto Ticket
    Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');
    Route::patch('/maintenance/{asset:code}', [MaintenanceController::class, 'update'])->name('maintenance.update');
    Route::post('/maintenance/run', [MaintenanceController::class, 'run'])->name('maintenance.run');
    
    
    //for dashboard.
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    
    
    //new asset add kora and warrenty date
   /* Route::get('/fix-pc02', function () {
        \App\Models\Asset::where('code', 'PC-02')->update([
            'warranty_end' => '2027-01-01',
            'warranty_notified_at' => null,
        ]);

        return redirect()->route('warranty.index');
    });
 */

    //for asset delete and update;   
    Route::patch('/assets/{asset:code}', [AssetController::class, 'update'])->name('assets.update');
    Route::delete('/assets/{asset:code}', [AssetController::class, 'destroy'])->name('assets.destroy');



    // for warranty alert use this
     Route::get('/warranty', [WarrantyController::class, 'index'])->name('warranty.index');
});