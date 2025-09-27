<?php

namespace App\Http\Controllers\Parameter\ProductCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParameterRequest as ProductCategoryRequest;
use App\Models\Product\ProductCategory as Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductCategory extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories_stats = [
            'active' => Category::where('is_active', true)->count(),
            'inactive' => Category::where('is_active', false)->count()
        ];
        $description = $request->query('description');
        $productCategories = Category::where('description', 'like', '%' . $description . '%')->paginate(5);
        return Inertia::render('parameter/productCategory/Index', compact('productCategories', 'categories_stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('parameter/productCategory/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCategoryRequest $request)
    {
        Category::create([
            'description' => $request->description,
            'observation' => $request->observation,
            'is_active' => $request->is_active
        ]);

        return redirect()->route('product_categories.index')->with('success', 'Cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $productCategory)
    {
        return Inertia::render('parameter/productCategory/Show', compact('productCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $productCategory)
    {
        return Inertia::render('parameter/productCategory/Edit', compact('productCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductCategoryRequest $request, Category $productCategory)
    {
        $productCategory->update([
            'description' => $request->input('description'),
            'observation' => $request->input('observation'),
            'is_active' => $request->input('is_active')
        ]);

        return redirect()->route('product_categories.index')->with('success', 'Actualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $productCategory)
    {
        $productCategory->delete();
        return redirect()->route('product_categories.index')->with('success', 'Deleted com sucesso!');
    }
}
