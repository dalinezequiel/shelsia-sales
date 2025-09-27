<?php

namespace App\Http\Controllers\Parameter\Supplier;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupplierRequest;
use App\Models\Supplier\Supplier;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $suppliers_stats = [
            'active' => Supplier::where('is_active', true)->count(),
            'inactive' => Supplier::where('is_active', false)->count()
        ];
        $name = $request->query('name');
        $suppliers = Supplier::where('name', 'like', '%' . $name . '%')->paginate(5);
        return Inertia::render('parameter/supplier/Index', compact('suppliers', 'suppliers_stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('parameter/supplier/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
        Supplier::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'is_active' => $request->is_active
        ]);

        return redirect()->route('suppliers.index')->with('success', 'Cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return Inertia::render('parameter/supplier/Show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return Inertia::render('parameter/supplier/Edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required'
        ]);

        $supplier->update([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'gender' => $request->input('gender'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'is_active' => $request->input('is_active')
        ]);

        return redirect()->route('suppliers.index')->with('success', 'Actualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Deleted com sucesso!');
    }
}
