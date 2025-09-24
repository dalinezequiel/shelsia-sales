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
        $more_less_sold = $this->sales_stats();
        $description = $request->query('description');
        $sales = Sale::where('description', 'like', '%' . $description . '%')->with(['details', 'details.product', 'paymentMethod'])
            ->paginate(5);
        return Inertia::render('sales/Index', compact('sales', 'more_less_sold'));
    }

    /**
     * Display a listing of the pos resource.
     */
    public function pos(Request $request)
    {
        $paymentMethods = PaymentMethod::where('is_active', True)->get();
        $description = $request->query('description');
        $sales = Sale::where('status', SaleStatus::PENDING)->whereDate('created_at', Carbon::now()->toDateString())
            ->with(['details', 'details.product', 'paymentMethod'])->get();
        $sale_stats = [
            'paid' => [
                'total' => Sale::where('status', SaleStatus::PAID)
                    ->whereDate('created_at', Carbon::now()->toDateString())->count(),
                'items' => Sale::where('status', SaleStatus::PAID)
                    ->whereDate('created_at', Carbon::now()
                        ->toDateString())->with('details')
                    ->get()
            ],
            'pending' => [
                'total' => Sale::where('status', SaleStatus::PENDING)
                    ->whereDate('created_at', Carbon::now()->toDateString())->count(),
                'items' => Sale::where('status', SaleStatus::PENDING)
                    ->whereDate('created_at', Carbon::now()
                        ->toDateString())->with('details')
                    ->get()
            ],
            'cancelled' => [
                'total' => Sale::where('status', SaleStatus::CANCELLED)
                    ->whereDate('created_at', Carbon::now()->toDateString())->count(),
                'items' => Sale::where('status', SaleStatus::CANCELLED)
                    ->whereDate('created_at', Carbon::now()
                        ->toDateString())->with('details')
                    ->get()
            ]
        ];
        $products = Product::where('is_active', True)->where('description', 'like', '%' . $description . '%')
            ->with('productCategory')->inRandomOrder()->limit(8)->get();
        return Inertia::render('sales/Create', compact('products', 'paymentMethods', 'description', 'sales', 'sale_stats'));
    }

    /**
     * calculate best selling product.
     */
    function sales_stats()
    {
        $stats = [
            'best_selling' => $this->groupByProduct()->sortByDesc('quantity_sold')->first(),
            'least_sold' => $this->groupByProduct()->sortByDesc('quantity_sold')->last()
        ];
        return $stats;
    }

    public function map_products()
    {
        $products = [];
        $sales = Sale::where('status', SaleStatus::PAID)->with(['details', 'details.product', 'details.product.supplier'])->get();
        foreach ($sales as $sale) {
            $products[] = $sale->details->map(fn($item) => [
                'product_id' => $item->product->id,
                'description' => $item->product->description,
                'supplier' => $item->product->supplier->name,
                'subtotal' => $item['quantity'] * ($item->product->promotional_price > 0 ?
                    $item->product->promotional_price : $item->product->sale_price),

                'profit_per_product' => $item['quantity'] * ($item->product->promotional_price > 0 ?
                    $item->product->promotional_price : $item->product->sale_price - $item->product->purchase_price),
                'image' => $item->product->image,
                'quantity_sold' => $item['quantity'],
                'number_of_sales' => 1
            ]);
        }
        return $products;
    }

    public function groupByProduct()
    {
        $products = [];
        foreach ($this->map_products() as $product) {
            foreach ($product as $item) {
                $products[] = $item;
            }
        }

        $items = collect($products);
        $groupByProduct = $items->groupBy('product_id')->map(function ($group) {
            return
                [
                    'product_id' => $group->first()['product_id'],
                    'description' => $group->first()['description'],
                    'supplier' => $group->first()['supplier'],
                    'image' => $group->first()['image'],
                    'subtotal' => $group->sum('subtotal'),
                    'profit_per_product' => $group->sum('profit_per_product'),
                    'quantity_sold' => $group->sum('quantity_sold'),
                    'number_of_sales' => $group->sum('number_of_sales')
                ];
        })->values();
        return $groupByProduct;
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

            $sale->details()->saveMany($items);
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
    public function show(Sale $sale)
    {
        $sales = Sale::where('id', $sale->id)->with(['details', 'details.product', 'paymentMethod'])->first();
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

            if ($request->can_update_stock)
                foreach ($request->details as $detail) {
                    $product = Product::find($detail['product_id']);
                    $current_stock = $product->available_stock;
                    $quantity = $detail['quantity'];

                    $new_stock = $current_stock + $quantity;
                    $product->available_stock = $new_stock;

                    $product->save();
                }

            DB::commit();
            return redirect()->route($request->can_update_stock ? 'sales.index' : 'sales.pos')
                ->with('success', 'Cancelled com sucesso!');
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
