<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Finance\Finance;
use App\Models\Product\Product;
use App\Models\Sales\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $indicators = [
            'finances' => [
                'total' => Finance::count(),
                'sum' => Finance::sum('amount'),
                'expenses' => [
                    'total' => Finance::where('is_active', false)->count(),
                    'sum' => Finance::where('is_active', false)->sum('amount')
                ],
                'income' => [
                    'total' => Finance::where('is_active', true)->count(),
                    'sum' => Finance::where('is_active', true)->sum('amount')
                ],
                'late_bills' => [
                    'total' => Finance::where('is_active', false)->whereDate('due_date', '<', Carbon::now()
                        ->toDateString())->count(),
                    'sum' => Finance::where('is_active', false)->whereDate('due_date', '<', Carbon::now()
                        ->toDateString())->sum('amount')
                ]
            ],
            'products' => ['total' => Product::count()],
            'sales' => [
                'total' => Sale::count(),
                'paid' => [
                    'total' => Sale::where('status', 'paid')->count(),
                    'items_to_sum' => Sale::where('status', 'paid')->with(['hasDetails', 'hasDetails.product'])->first()
                ],
                'pending' => [
                    'total' => Sale::where('status', 'pending')->count(),
                    'items_to_sum' => Sale::where('status', 'pending')->with(['hasDetails', 'hasDetails.product'])->first()
                ],
                'cancelled' => [
                    'total' => Sale::where('status', 'cancelled')->count(),
                    'items_to_sum' => Sale::where('status', 'cancelled')->with(['hasDetails', 'hasDetails.product'])->first()
                ]
            ]
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
