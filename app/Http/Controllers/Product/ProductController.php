<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get();
        return Inertia::render('product/Index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('product/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'barcode' => 'required',
            'description' => 'required'
        ]);

        Product::create([
            'barcode' => $request -> barcode,
            'description' => $request -> description,
            'category' => $request -> category,
            'unit' => $request -> unit,
            'supplier' => $request -> supplier,
            'purchase_price' => $request -> purchase_price,
            'sale_price' => $request -> sale_price,
            'validity' => $request -> validity,
            'minimum_stock' => $request -> minimum_stock,
            'maximum_stock' => $request -> maximum_stock,
            'available_stock' => $request -> available_stock,
            'location' => $request -> location,
            'image' => $request -> image,
            'is_active' => $request -> is_active
        ]);

        return redirect()->route('products.index')->with('success', 'Cadastrado com sucesso!');
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
    public function edit(Product $product)
    {
        return Inertia::render('product/Edit', compact('product'));
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
