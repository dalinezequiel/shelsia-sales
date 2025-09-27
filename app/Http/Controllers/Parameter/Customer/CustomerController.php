<?php

namespace App\Http\Controllers\Parameter\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $customers_stats = [
            'active' => Customer::where('is_active', true)->count(),
            'inactive' => Customer::where('is_active', false)->count()
        ];
        $name = $request->query('name');
        $customers = Customer::where('name', 'like', '%' . $name . '%')->paginate(5);
        return Inertia::render('parameter/customer/Index', compact('customers', 'customers_stats'));
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
    public function store(StoreCustomerRequest $request)
    {
        Customer::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'is_active' => $request->is_active
        ]);

        return redirect()->route('customers.index')->with('success', 'Cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return Inertia::render('parameter/customer/Show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return Inertia::render('parameter/customer/Edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCustomerRequest $request, Customer $customer)
    {
        $customer->update([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'gender' => $request->input('gender'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'is_active' => $request->input('is_active')
        ]);

        return redirect()->route('customers.index')->with('success', 'Actualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Deleted com sucesso!');
    }
}
