<?php

namespace App\Http\Controllers\Analysis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class AnalysisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forecast_endpoint = 'http://127.0.0.1:5000/preditions';
        $sales = [
            "periods" => 10,
            "freq" => "d",
            "data" => [
                [
                   "ds" => "2007-12-10",
		 	        "y" => 9.59076113897809 
                ],
                [
                    "ds" => "2007-12-11",
		 	        "y" => 8.51959031601596
                ],
                [
                    "ds" => "2007-12-12",
		 	        "y" => 8.18367658262066
                ],
                [
                    "ds" => "2007-12-13",
		 	        "y" => 8.07246736935477
                ],
                [
                    "ds" => "2007-12-14",
		 	        "y" => 7.8935720735049
                ]
            ]
        ];
        
        $forecasts = Http::post($forecast_endpoint, [$sales]) -> json();
        return Inertia::render('analysis/Index', compact('forecasts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
