<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/planning', function () {
    return view('planning.index');
})->name('planning.index');

Route::post('/travel/search', function () {
    // Proses pencarian trip, bisa ambil input dari request
    // return view('planning.result');
    return back()->with('success', 'Search submitted!');
})->name('travel.search');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
