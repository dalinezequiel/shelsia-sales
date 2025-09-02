<?php

namespace App\Http\Controllers\Parameter\Period;

use App\Http\Controllers\Controller;
use App\Models\Period\Period;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $description = $request->query('description');
        $periods = Period::where('description', 'like', '%' . $description . '%')->paginate(5);
        return Inertia::render('parameter/period/Index', compact('periods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('parameter/period/Create');
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
    public function show(Period $period)
    {
        return Inertia::render('parameter/period/Show', compact('period'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Period $period)
    {
        return Inertia::render('parameter/period/Edit', compact('period'));
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
    public function destroy(Period $period)
    {
        $period->delete();
        return redirect()->route('periods.index')->with('success', 'Deleted com sucesso!');
    }
}
