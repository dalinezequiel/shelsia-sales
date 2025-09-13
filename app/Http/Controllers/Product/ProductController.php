<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod\PaymentMethod;
use Illuminate\Support\Facades\Storage;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Models\Product\Unit;
use App\Models\Supplier\Supplier;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $description = $request->query('description');
        $products = Product::where('description', 'like', '%' . $description . '%')->with('productCategory')->paginate(5);
        return Inertia::render('product/Index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units = Unit::where('is_active', True)->get();
        $suppliers = Supplier::where('is_active', True)->get();
        $productCategories = ProductCategory::where('is_active', True)->get();
        return Inertia::render('product/Create', compact('productCategories', 'suppliers', 'units'));
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

        $product_category = ProductCategory::find($request->product_category_id);
        $unit = Unit::find($request->unit_id);
        $supplier = Supplier::find($request->supplier_id);

        $product = new Product([
            'barcode' => $request->barcode,
            'description' => $request->description,
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->sale_price,
            'promotional_price' => $request->promotional_price,
            'validity' => $request->validity,
            'minimum_stock' => $request->minimum_stock,
            'maximum_stock' => $request->maximum_stock,
            'available_stock' => $request->available_stock,
            'location' => $request->location,
            'image' => $image_path,
            'is_active' => $request->is_active
        ]);

        $product->productCategory()->associate($product_category);
        $product->unit()->associate($unit);
        $product->supplier()->associate($supplier);
        $product->save();

        return redirect()->route('products.index')->with('success', 'Cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = Product::where('id', $product->id)->with(['productCategory', 'supplier'])->first();
        return Inertia::render('product/Show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $units = Unit::where('is_active', True)->get();
        $suppliers = Supplier::where('is_active', True)->get();
        $productCategories = ProductCategory::where('is_active', True)->get();
        return Inertia::render('product/Edit', compact('product', 'productCategories', 'suppliers', 'units'));
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

        $product->product_category_id = $request->input('category');
        $product->unit_id = $request->input('unit');
        $product->supplier_id = $request->input('supplier');

        $product->barcode = $request->input('barcode');
        $product->description = $request->input('description');
        $product->purchase_price = $request->input('purchase_price');
        $product->sale_price = $request->input('sale_price');
        $product->promotional_price = $request->input('promotional_price');
        $product->validity = $request->input('validity');
        $product->minimum_stock = $request->input('minimum_stock');
        $product->maximum_stock = $request->input('maximum_stock');
        $product->available_stock = $request->input('available_stock');
        $product->location = $request->input('location');
        $product->is_active = $request->input('is_active');
        $product->save();

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
