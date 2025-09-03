<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Financial\FinancialController;
use App\Http\Controllers\Sales\SalesController;
use App\Http\Controllers\Analysis\AnalysisController;
use App\Http\Controllers\Parameter\Customer\CustomerController;
use App\Http\Controllers\Parameter\Supplier\SupplierController;
use App\Http\Controllers\Parameter\PaymentMethod\PaymentMethod;
use App\Http\Controllers\Parameter\Period\PeriodController;
use App\Http\Controllers\Parameter\ProductCategory\ProductCategory;
use App\Http\Controllers\Parameter\Unit\UnitController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('products', ProductController::class);
Route::post('products/photo', [ProductController::class, 'photo']);

Route::resource('financial', FinancialController::class);
Route::resource('sales', SalesController::class);
Route::get('transactions/pos', [SalesController::class, 'pos'])->name('sales.pos');

Route::resource('analysis', AnalysisController::class);
Route::prefix('parameters')->group(function () {
    Route::resource('/customers', CustomerController::class);
    Route::resource('/suppliers', SupplierController::class);
    Route::resource('/units', UnitController::class);
    Route::resource('/product_categories', ProductCategory::class);
    Route::resource('/payment_methods', PaymentMethod::class);
    Route::resource('/periods', PeriodController::class);
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
