<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Finance\Finance;
use App\Models\Product\Product;
use App\Models\Sales\Sale;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $finance = [
            'total_expenses' => Finance::where('is_active', false)->sum('amount'),
            'total_income' => Finance::where('is_active', true)->sum('amount')
        ];
        $product = Product::where('is_active', true)->count();
        $sale = Sale::where('status', 'paid')->count();

        $indicators = [
            'finance' => $finance,
            'product' => $product,
            'sale' => $sale
        ];
        return Inertia::render('Dashboard', compact('indicators'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
