<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    
    if(Auth::user()->is_admin == 1){
        return view('admin.dashboard');
    }else{
        return view('dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('isAdmin')->group(function () {
    // Route::get('admin/dashboard', [AuthenticatedSessionController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/Client-registration-report', [ReportController::class, 'registrationReport'])->name('admin.registration_report');
    Route::get('/Client-technology-report', [ReportController::class, 'technologyReport'])->name('admin.technology_report');
    Route::get('gmaps', [ReportController::class,'gmaps'])->name('map_based_report');
});

require __DIR__.'/auth.php';
