<?php

namespace App\Http\Controllers\Parameter\Unit;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUnitRequest;
use App\Models\Product\Unit;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $units_stats = [
            'active' => Unit::where('is_active', true)->count(),
            'inactive' => Unit::where('is_active', false)->count()
        ];
        $description = $request->query('description');
        $units = Unit::where('description', 'like', '%' . $description . '%')->paginate(5);
        return Inertia::render('parameter/unit/Index', compact('units', 'units_stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('parameter/unit/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUnitRequest $request)
    {
        Unit::create([
            'description' => $request->description,
            'abbreviation' => $request->abbreviation,
            'observation' => $request->observation,
            'is_active' => $request->is_active
        ]);

        return redirect()->route('units.index')->with('success', 'Cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        return Inertia::render('parameter/unit/Show', compact('unit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        return Inertia::render('parameter/unit/Edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'description' => 'required'
        ]);

        $unit->update([
            'description' => $request->input('description'),
            'abbreviation' => $request->input('abbreviation'),
            'observation' => $request->input('observation'),
            'is_active' => $request->input('is_active')
        ]);

        return redirect()->route('units.index')->with('success', 'Actualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect()->route('units.index')->with('success', 'Deleted com sucesso!');
    }
}
