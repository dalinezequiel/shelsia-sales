<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Registration\RegistrationController;
use App\Http\Controllers\Financial\FinancialController;
use App\Http\Controllers\Sales\SalesController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('registrations', RegistrationController::class);
Route::resource('financial', FinancialController::class);
Route::resource('sales', SalesController::class);

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
