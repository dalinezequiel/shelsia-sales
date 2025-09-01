<?php

namespace App\Http\Controllers\Parameter\PaymentMethod;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod\PaymentMethod as Payment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentMethod extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $description = $request->query('description');
        $paymentMethods = Payment::where('description', 'like', '%' . $description . '%')->paginate(5);
        return Inertia::render('parameter/paymentMethod/Index', compact('paymentMethods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('parameter/paymentMethod/Create');
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
    public function show(Payment $paymentMethod)
    {
        return Inertia::render('parameter/paymentMethod/Show', compact('paymentMethod'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $paymentMethod)
    {
        return Inertia::render('parameter/paymentMethod/Show', compact('paymentMethod'));
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
    public function destroy(Payment $paymentMethod)
    {
        $paymentMethod->delete();
        return redirect()->route('payment_methods.index')->with('success', 'Deleted com sucesso!');
    }
}
