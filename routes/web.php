<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Financial\FinancialController;
use App\Http\Controllers\Sales\SalesController;
use App\Http\Controllers\Parameter\Customer\CustomerController;
use App\Http\Controllers\Parameter\Supplier\SupplierController;
use App\Http\Controllers\Parameter\Account\AccountController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('products', ProductController::class);
Route::resource('financial', FinancialController::class);
Route::resource('sales', SalesController::class);
Route::prefix('parameters')->group(function(){
    Route::resource('customers', CustomerController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('accounts', AccountController::class);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
