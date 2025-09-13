<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Finance\Finance;
use App\Models\PaymentMethod\PaymentMethod;
use App\Models\Period\Period;
use App\Models\Supplier\Supplier;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $description = $request->query('description');
        $accounts = Finance::where('description', 'like', '%' . $description . '%')->paginate(5);

        $paymentMethods = PaymentMethod::where('is_active', True)->get();
        return Inertia::render('financial/Index', compact('accounts', 'paymentMethods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::where('is_active', True)->get();
        $paymentMethods = PaymentMethod::where('is_active', True)->get();
        $periods = Period::where('is_active', True)->get();
        return Inertia::render('financial/Create', compact('suppliers', 'paymentMethods', 'periods'));
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
    public function show(Finance $finance)
    {
        return Inertia::render('financial/Show', compact('finance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Finance $finance)
    {
        $suppliers = Supplier::where('is_active', True)->get();
        $paymentMethods = PaymentMethod::where('is_active', True)->get();
        $periods = Period::where('is_active', True)->get();
        return Inertia::render('financial/Edit', compact('finance', 'suppliers', 'paymentMethods', 'periods'));
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
    public function destroy(Finance $finance)
    {
        $finance->delete();
        return redirect()->route('finances.index')->with('success', 'Deleted com sucesso!');
    }
}
