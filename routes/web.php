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

Route::post('/planning', function (\Illuminate\Http\Request $request) {
    // Simpan tanggal ke database atau session sesuai kebutuhan
    $start = $request->input('start_date');
    $end = $request->input('end_date');
    // Contoh: simpan ke session
    session(['planning_start_date' => $start, 'planning_end_date' => $end]);
    return back()->with('success', 'Dates saved!');
})->name('planning.store');

Route::post('/travel/search', function () {
    // Proses pencarian trip, bisa ambil input dari request
    // return view('planning.result');
    return back()->with('success', 'Search submitted!');
})->name('travel.search');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
