<?php

namespace App\Http\Controllers\Analysis;

use App\Http\Controllers\Controller;
use App\Models\Finance\Finance;
use App\Models\Sales\Sale;
use App\SaleStatus;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class AnalysisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $finances = [
                'total_expenses' => Finance::where('category', 'expense')->sum('amount'),
                'total_income' => Finance::where('category', 'income')->sum('amount')
            ];

            $sales = $this->saleDataFrame();
            $data_for_forecasting = [
                "period" => $request->query('period', '1'),
                "frequency" => $request->query('frequency', 'd'),
                "sales" => $sales
            ];

            $search_period = $data_for_forecasting['period'];
            $forecasts = Http::post(env('FORECAST_BASE_URL'), [$data_for_forecasting])->json();
            return Inertia::render('analysis/Index', compact('forecasts', 'finances', 'sales', 'search_period'));
        } catch (Exception $ex) {
            return response()->json([
                'message_error' => $ex->getMessage()
            ]);
        }
    }

    function saleDataFrame()
    {
        $dataFrame = [];
        $sales = Sale::where('status', SaleStatus::PAID)->with('details')->get();
        foreach ($sales as $sale) {
            $subtotal = $sale->details->reduce(fn($acc, $detail) => $acc + ($detail['quantity'] * $detail['price']), 0);
            $dataFrame[] = [
                'ds' => strval($sale->created_at->format('Y-m-d')),
                'y' => floatval($subtotal + $sale->shipping - $sale->discount)
            ];
        }

        $items = collect($dataFrame);
        $groupByMonth = $items->groupBy('ds')->map(function ($group) {
            return ['ds' => $group->first()['ds'], 'y' => $group->sum('y')];
        })->values();

        return $groupByMonth;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groupByMonth[] = [
            'ds' => '2025-09-20',
            'y' => 1000
        ];
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
