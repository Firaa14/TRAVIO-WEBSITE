<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\OpenTripController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarBookingController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PackageBookingController;
use App\Http\Controllers\RentalMobilController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HotelBookingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

// Landing Page Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Planning Routes - Requires Authentication
Route::middleware('auth')->group(function () {
    Route::get('/planning', [PlanningController::class, 'index'])->name('planning');
    Route::post('/planning/calculate', [PlanningController::class, 'calculate'])->name('planning.calculate');
    Route::post('/planning/checkout', [PlanningController::class, 'checkout'])->name('planning.checkout');
    Route::get('/planning/hotel-rooms/{hotelId}', [PlanningController::class, 'getHotelRooms'])->name('planning.hotelRooms');
});

Route::get('/checkout/planning', [CheckoutController::class, 'planningCheckout'])->name('checkout.planning')->middleware('auth');
Route::post('/checkout/planning/submit', [CheckoutController::class, 'submitPlanningCheckout'])->name('checkout.planning.submit')->middleware('auth');
Route::get('/planning/booking/success/{bookingId}', [CheckoutController::class, 'planningBookingSuccess'])->name('planning.booking.success')->middleware('auth');

// Profile Routes - Requires Authentication
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/bookings/pdf', [ProfileController::class, 'bookingsPdf'])->name('profile.bookings.pdf');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/upload', [ProfileController::class, 'upload'])->name('profile.upload');
});

Route::get('/destination/{id}/{tab?}', [DestinationController::class, 'show'])->name('destination.show');

// Gallery Routes
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store')->middleware('auth');
Route::delete('/gallery/{gallery}', [GalleryController::class, 'destroy'])->name('gallery.destroy')->middleware('auth');

Route::get('/opentrip', [OpenTripController::class, 'index'])->name('opentrip.index');
Route::get('/destinasi', [DestinasiController::class, 'index'])->name('destinasi.index');
Route::get('/destinasi/{id}', [DestinasiController::class, 'show'])->name('destinasi.show');
Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{id}', [HotelController::class, 'show'])->name('hotels.show');
// Car Routes
Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
Route::get('/cars/{id}', [CarController::class, 'show'])->name('cars.show');

// Package Routes
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{id}', [PackageController::class, 'show'])->name('packages.show');

// Package Booking Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/package-booking/checkout/{packageId}', [PackageBookingController::class, 'create'])->name('package.booking.create');
    Route::post('/package-booking/store', [PackageBookingController::class, 'store'])->name('package.booking.store');
    Route::get('/package-booking/success/{bookingId}', [PackageBookingController::class, 'success'])->name('package.booking.success');
    Route::post('/package-booking/calculate-price', [PackageBookingController::class, 'calculatePrice'])->name('package.booking.calculate.price');
});

// Car Booking Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/car-booking/checkout/{carId}', [CarBookingController::class, 'create'])->name('car.booking.create');
    Route::post('/car-booking/store', [CarBookingController::class, 'store'])->name('car.booking.store');
    Route::get('/car-booking/success/{bookingId}', [CarBookingController::class, 'success'])->name('car.booking.success');
    Route::post('/car-booking/calculate-price', [CarBookingController::class, 'calculatePrice'])->name('car.booking.calculate.price');
});

// Legacy Car Routes (for old rental system)
Route::get('/cars/mobil/{id}', [RentalMobilController::class, 'show'])->name('cars.mobil.show');
Route::get('/cars/mobil/{id}/form', [RentalMobilController::class, 'form'])->name('cars.mobil.form');
Route::post('/cars/mobil/{id}/submit', [RentalMobilController::class, 'submit'])->name('cars.mobil.submit');
Route::get('/cars/mobil/checkout/{id?}', [RentalMobilController::class, 'checkout'])->name('cars.mobil.checkout');

// Open Trip Routes
Route::get('/opentrip/{id}', [TripController::class, 'show'])->name('opentrip.show');
Route::get('/opentrip/{id}/checkout', [TripController::class, 'checkout'])->name('opentrip.checkout')->middleware('auth');
Route::post('/opentrip/{id}/checkout', [TripController::class, 'checkoutSubmit'])->name('opentrip.checkout.submit')->middleware('auth');
Route::get('/opentrip/{bookingId}/success', [TripController::class, 'success'])->name('opentrip.success')->middleware('auth');

// Legacy open trip routes (redirect to new checkout)
Route::get('/opentrip/{id}/register', [TripController::class, 'register'])->name('opentrip.register');
Route::post('/opentrip/{id}/register', [TripController::class, 'registerSubmit'])->name('opentrip.register.submit');

Route::get('/checkout/{tripId}', [App\Http\Controllers\CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/checkout/submit', [App\Http\Controllers\CheckoutController::class, 'submit'])->name('checkout.submit');
Route::get('/invoice/{bookingId}', [
    App\Http\Controllers\CheckoutController::class,
    'invoice'
])->name('checkout.invoice');
Route::get('/checkout-hotel', [CheckoutController::class, 'checkoutHotel'])->name('checkout.hotel');
Route::post('/checkout-hotel/submit', [CheckoutController::class, 'submitHotel'])->name('checkout.hotel.submit');
Route::get('/invoice-hotel/{bookingId}', [CheckoutController::class, 'invoiceHotel'])->name('checkout.hotel.invoice');

// Destination Booking Routes with Auth
Route::middleware('auth')->group(function () {
    Route::get('/destination-booking/{destinationId}', [CheckoutController::class, 'createDestinationBooking'])->name('destination.booking.create');
    Route::post('/destination-booking/store', [CheckoutController::class, 'storeDestinationBooking'])->name('destination.booking.store');
    Route::get('/destination-booking/success/{bookingId}', [CheckoutController::class, 'destinationBookingSuccess'])->name('destination.booking.success');
    Route::get('/invoice-destination/{bookingId}', [CheckoutController::class, 'invoiceDestination'])->name('checkout.destination.invoice');
    Route::get('/invoice-destinasi/{bookingId}', [CheckoutController::class, 'invoiceDestinasi'])->name('checkout.destinasi.invoice');
});

// Route for invoice mobil
Route::get('/invoice-mobil/{bookingId}', [App\Http\Controllers\RentalMobilController::class, 'invoiceMobil'])->name('invoice.mobil');

// Hotel Booking Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/hotel-booking/checkout/{hotelId}/{roomId}', [HotelBookingController::class, 'create'])->name('hotel.booking.create');
    Route::post('/hotel-booking/store', [HotelBookingController::class, 'store'])->name('hotel.booking.store');
    Route::get('/hotel-booking/success/{id}', [HotelBookingController::class, 'success'])->name('booking.success');
    Route::get('/my-bookings', [HotelBookingController::class, 'index'])->name('my.bookings');
    Route::patch('/hotel-booking/cancel/{id}', [HotelBookingController::class, 'cancel'])->name('hotel.booking.cancel');
    Route::post('/hotel-booking/calculate-price', [HotelBookingController::class, 'calculatePrice'])->name('hotel.booking.calculate.price');
});

// Development/Testing Routes
if (config('app.debug')) {
    Route::get('/debug/bookings/clear-test', [HotelBookingController::class, 'clearTestBookings'])->name('debug.clear.bookings');
}

