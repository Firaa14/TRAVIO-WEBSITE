<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OpenTripController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\RentalMobilController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\CheckoutController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/planning', [PlanningController::class, 'index'])->name('planning');
Route::post('/planning/calculate', [PlanningController::class, 'calculate'])->name('planning.calculate');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/bookings/pdf', [ProfileController::class, 'bookingsPdf'])->name('profile.bookings.pdf');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/profile/upload', [ProfileController::class, 'upload'])->name('profile.upload');
Route::get('/destination/{id}/{tab?}', [DestinationController::class, 'show'])->name('destination.show');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/upload-bukti', [CartController::class, 'uploadBukti'])->name('cart.uploadBukti');
Route::get('/opentrip', [OpenTripController::class, 'index'])->name('opentrip.index');
Route::get('/destinations', [DestinasiController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{id}', [DestinasiController::class, 'show'])->name('destinations.show');
Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{id}', [App\Http\Controllers\DetailHotelController::class, 'show'])->name('hotels.show');
Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
Route::get('/cars/{id}', [CarController::class, 'show'])->name('cars.show');
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{id}', [App\Http\Controllers\DetailPaketController::class, 'show'])->name('packages.show');
Route::get('/hotel/{id}', [App\Http\Controllers\DetailHotelController::class, 'show'])->name('hotel.show');
Route::get('/cars/{id}', [RentalMobilController::class, 'show'])->name('cars.show');
Route::get('/cars/{id}/form', [RentalMobilController::class, 'form'])->name('cars.form');
Route::post('/cars/{id}/submit', [RentalMobilController::class, 'submit'])->name('cars.submit');
Route::get('/opentrip/{id}', [TripController::class, 'show'])->name('opentrip.show');
Route::get('/opentrip/{id}/register', [TripController::class, 'register'])->name('opentrip.register');
Route::post('/opentrip/{id}/register', [TripController::class, 'registerSubmit'])->name('opentrip.register.submit');
Route::get('/checkout/{tripId}', [App\Http\Controllers\CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/checkout/submit', [App\Http\Controllers\CheckoutController::class, 'submit'])->name('checkout.submit');
Route::get('/invoice/{bookingId}', [
    App\Http\Controllers\CheckoutController::class,
    'invoice'
])->name('checkout.invoice');

// Route untuk checkout destinasi
Route::get('/checkout-destinasi', [CheckoutController::class, 'checkoutDestinasi'])->name('checkout.destinasi');