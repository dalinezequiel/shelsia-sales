<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
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

        $image_path = null;
        if ($request->hasFile('image')) {
            $file_name = rand(0, 9999999) . '-' . $request->file('image')->getClientOriginalName();
            $image_path = $request->file('image')->storeAs('products', $file_name);
        }

        Product::create([
            'barcode' => $request->barcode,
            'description' => $request->description,
            'category' => $request->category,
            'unit' => $request->unit,
            'supplier' => $request->supplier,
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->sale_price,
            'validity' => $request->validity,
            'minimum_stock' => $request->minimum_stock,
            'maximum_stock' => $request->maximum_stock,
            'available_stock' => $request->available_stock,
            'location' => $request->location,
            'image' => $image_path,
            'is_active' => $request->is_active
        ]);

        return redirect()->route('products.index')->with('success', 'Cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return Inertia::render('product/Show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return Inertia::render('product/Edit', compact('product'));
    }

    /**
     * Update the specified image in storage.
     */
    public function photo(Request $request)
    {
        $image_path = null;
        if ($request->hasFile('newPhoto')) {
            $file_name = rand(0, 9999999) . '-' . $request->file('newPhoto')->getClientOriginalName();
            $image_path = $request->file('newPhoto')->storeAs('products', $file_name);
            $product = Product::where('id', $request->id)->first();
            $product->image = $image_path;
            $product->save();
            Storage::delete($request->deletePhoto);
        }

        return redirect()->route('products.index')->with('success', 'Imagem actualizada com sucesso!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'barcode' => 'required',
            'description' => 'required'
        ]);

        $image_path = null;
        if ($request->hasFile('image')) {
            $file_name = rand(0, 9999999) . '-' . $request->file('image')->getClientOriginalName();
            $image_path = $request->file('image')->storeAs('products', $file_name);
        }

        $product->update([
            'barcode' => $request->input('barcode'),
            'description' => $request->input('description'),
            'category' => $request->input('category'),
            'unit' => $request->input('unit'),
            'supplier' => $request->input('supplier'),
            'purchase_price' => $request->input('purchase_price'),
            'sale_price' => $request->input('sale_price'),
            'validity' => $request->input('validity'),
            'minimum_stock' => $request->input('minimum_stock'),
            'maximum_stock' => $request->input('maximum_stock'),
            'available_stock' => $request->input('available_stock'),
            'location' => $request->input('location'),
            'image' => $image_path,
            'is_active' => $request->input('is_active')
        ]);

        return redirect()->route('products.index')->with('success', 'Actualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Deleted com sucesso!');
    }
}
