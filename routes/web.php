<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PackageController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/planning', [PlanningController::class, 'index'])->name('planning');
Route::post('/planning/calculate', [PlanningController::class, 'calculate'])->name('planning.calculate');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/profile/upload', [ProfileController::class, 'upload'])->name('profile.upload');
Route::get('/travel/{id}', [PackageController::class, 'show'])->name('travel.show');
Route::get('/package/details', function () {
    $hideNavbar = true; // untuk disembunyikan di layout
    return view('package.details', compact('hideNavbar'));
})->name('package.details');


