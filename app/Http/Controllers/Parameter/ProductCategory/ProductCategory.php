<?php

namespace App\Http\Controllers\Parameter\ProductCategory;

use App\Http\Controllers\Controller;
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
        $description = $request->query('description');
        $productCategories = Category::where('description', 'like', '%' . $description . '%')->paginate(5);
        return Inertia::render('parameter/productCategory/Index', compact('productCategories'));
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
    public function store(Request $request)
    {
        //
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
