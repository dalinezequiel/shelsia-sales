<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod\PaymentMethod;
use App\Models\Product\Product;
use App\Models\Sales\Sale;
use App\Models\Sales\SaleDetail;
use App\SaleStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Exception;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $description = $request->query('description');
        $sales = Sale::where('description', 'like', '%' . $description . '%')->with(['hasDetails', 'hasDetails.product', 'paymentMethod'])
            ->paginate(5);
        return Inertia::render('sales/Index', compact('sales'));
    }

    /**
     * Display a listing of the pos resource.
     */
    public function pos(Request $request)
    {
        $paymentMethods = PaymentMethod::where('is_active', True)->get();
        $description = $request->query('description');
        $sales = Sale::where('status', SaleStatus::PENDING)->whereDate('created_at', Carbon::now()->toDateString())
            ->with(['hasDetails', 'hasDetails.product', 'paymentMethod'])->get();
        $sale_stats = [
            'paid' => [
                'total' => Sale::where('status', SaleStatus::PAID)
                    ->whereDate('created_at', Carbon::now()->toDateString())->count(),
                'items' => Sale::where('status', SaleStatus::PAID)
                    ->whereDate('created_at', Carbon::now()
                        ->toDateString())->with('hasDetails')
                    ->get()
            ],
            'pending' => [
                'total' => Sale::where('status', SaleStatus::PENDING)
                    ->whereDate('created_at', Carbon::now()->toDateString())->count(),
                'items' => Sale::where('status', SaleStatus::PENDING)
                    ->whereDate('created_at', Carbon::now()
                        ->toDateString())->with('hasDetails')
                    ->get()
            ],
            'cancelled' => [
                'total' => Sale::where('status', SaleStatus::CANCELLED)
                    ->whereDate('created_at', Carbon::now()->toDateString())->count(),
                'items' => Sale::where('status', SaleStatus::CANCELLED)
                    ->whereDate('created_at', Carbon::now()
                        ->toDateString())->with('hasDetails')
                    ->get()
            ]
        ];
        $products = Product::where('is_active', True)->where('description', 'like', '%' . $description . '%')
            ->inRandomOrder()->limit(8)->get();
        return Inertia::render('sales/Create', compact('products', 'paymentMethods', 'description', 'sales', 'sale_stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('sales/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'payment_method_id' => 'required'
        ]);

        try {
            DB::beginTransaction();
            $payment_method = PaymentMethod::find($request->payment_method_id);
            $sale = new Sale([
                'description' => 'VD' . rand(10000000, 99999999),
                'customer_name' => $request->customer_name,
                'discount' => $request->discount,
                'shipping' => $request->shipping,
                'status' => $request->status
            ]);

            $sale->paymentMethod()->associate($payment_method);
            $sale->save();


            $items = [];
            foreach ($request->details as $detail) {
                $sale_detail = new SaleDetail([
                    'quantity' => $detail['quantity'],
                    'price' => $detail['price'],
                ]);

                $product = Product::find($detail['product_id']);
                $current_stock = $product->available_stock;
                $quantity = $detail['quantity'];

                $new_stock = $current_stock - $quantity;
                $product->available_stock = $new_stock;

                $sale_detail->product()->associate($product);
                $items[] = $sale_detail;

                $product->save();
            }

            $sale->hasDetails()->saveMany($items);
            DB::commit();
            return redirect()->route('sales.pos')->with('success', 'Venda realizada com sucesso!');
        } catch (Exception $ex) {
            DB::rollback();
            echo $ex;
            return redirect()->route('sales.pos')->with('error', $ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        $sales = Sale::where('id', $sale->id)->with(['hasDetails', 'hasDetails.product', 'paymentMethod'])->first();
        return Inertia::render('sales/Show', compact('sales'));
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
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $sale = Sale::find($request->sale_id);
            $sale->status = $request->status;
            $sale->save();

            foreach ($request->has_details as $detail) {
                $product = Product::find($detail['product_id']);
                $current_stock = $product->available_stock;
                $quantity = $detail['quantity'];

                $new_stock = $current_stock + $quantity;
                $product->available_stock = $new_stock;

                $product->save();
            }

            DB::commit();
            return redirect()->route('sales.index')->with('success', 'Cancelled com sucesso!');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->route('sales.index')->with('error', $ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Deleted com sucesso!');
    }
}
