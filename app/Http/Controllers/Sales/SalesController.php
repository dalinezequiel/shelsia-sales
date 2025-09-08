<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod\PaymentMethod;
use App\Models\Product\Product;
use App\Models\Sales\Sale;
use App\Models\Sales\SaleDetail;
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
        $sales = Sale::where('description', 'like', '%' . $description . '%')->with('hasDetails')->paginate(5);
        return Inertia::render('sales/Index', compact('sales'));
    }

    /**
     * Display a listing of the pos resource.
     */
    public function pos(Request $request)
    {
        $paymentMethods = PaymentMethod::where('is_active', True)->get();
        $description = $request->query('description');
        $products = Product::where('is_active', True)->where('description', 'like', '%' . $description . '%')->inRandomOrder()->limit(8)->get();
        return Inertia::render('sales/Create', compact('products', 'paymentMethods', 'description'));
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
            'payment_method' => 'required'
        ]);

        $sale_details = $request->details;
        try {
            DB::beginTransaction();
            $sale = Sale::create([
                'description' => 'VD' . rand(10000000, 99999999),
                'customer_name' => $request->customer_name,
                'discount' => $request->discount,
                'shipping' => $request->shipping,
                'payment_method' => $request->payment_method
            ]);

            $sale_details = $request->details;
            $items = [];
            foreach ($sale_details as $detail) {
                $dt = new SaleDetail([
                    // 'product_id' => $detail['product_id'],
                    'product_name' => $detail['product_name'],
                    'quantity' => $detail['quantity'],
                    'price' => $detail['price'],
                ]);
                // $dt->belongsToProduct()->associate()
                // $items[]=$dt;
                
                $product = Product::find($detail['product_id']);
                $current_stock = $product->available_stock;
                $quantity = $detail['quantity'];
                
                $new_stock = $current_stock - $quantity;
                $product->available_stock = $new_stock;
                // $detail = new SaleDetail(['product_id' => $detail['product_id']]);
                $dt->belongsToProduct()->associate($product);
                $items[]=$dt;

                //  dd($items);

                $product->save();
            }
            // dd($sale);

            $sale->hasDetails()->saveMany($items);
            DB::commit();
            return redirect()->route('sales.pos')->with('success', 'Venda realizada com sucesso!');
        } catch (Exception $ex) {
            DB::rollback();
            return redirect()->route('sales.pos')->with('error', $ex);
        }
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
        $sale = Sale::find($request->sale_id);
        $sale->status = 'cancel';
        $sale->save();
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
