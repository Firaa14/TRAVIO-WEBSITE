<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DestinasiController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\HotelDetailController;
use App\Http\Controllers\Admin\HotelRoomController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\BookingController;

// Admin Authentication Routes (tanpa prefix /admin)
Route::prefix('admin')->name('admin.')->group(function () {
    // Default route - redirect to login if not authenticated
    Route::get('/', function () {
        if (auth()->guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login');
    });

    // Guest routes (belum login)
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login']);
        Route::get('/register', [AdminAuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [AdminAuthController::class, 'register']);
    });

    // Authenticated routes (sudah login)
    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // CRUD Routes untuk semua modul
        Route::resource('destinasi', DestinasiController::class);
        Route::resource('destination', DestinationController::class);
        Route::resource('hotel', HotelController::class);
        Route::resource('hotel-detail', HotelDetailController::class);
        Route::resource('hotel-room', HotelRoomController::class);
        Route::resource('car', CarController::class);
        Route::resource('package', PackageController::class);
        
        // Booking Management Routes
        Route::prefix('bookings')->name('bookings.')->controller(BookingController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/destinasi', 'destinasiBookings')->name('destinasi');
            Route::get('/destination', 'destinationBookings')->name('destination');
            Route::get('/hotel', 'hotelBookings')->name('hotel');
            Route::get('/car', 'carBookings')->name('car');
            Route::get('/package', 'packageBookings')->name('package');
            Route::patch('/{type}/{id}/status', 'updateStatus')->name('updateStatus');
        });
    });
});