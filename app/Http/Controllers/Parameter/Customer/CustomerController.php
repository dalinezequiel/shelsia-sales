<?php

namespace App\Http\Controllers\Parameter\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Inertia::render('parameter/customer/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return Inertia::render('parameter/customer/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required'
        ]);

        Customer::create([
            'name' => $request -> name,
            'surname' => $request -> surname,
            'gender' => $request -> gender,
            'phone' => $request -> phone,
            'email' => $request -> email,
            'address' => $request -> address,
            'is_active' => $request -> status
        ]);

        return redirect()->route('customers.create')->with('success', 'Cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $customer='';
        return Inertia::render('parameter/customer/Show', [
            $customer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //
        $customer='';
        return Inertia::render('parameter/customer/Edit', [
            $customer
        ]);
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
