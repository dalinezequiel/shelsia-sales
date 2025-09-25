<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Models\Finance\Finance;
use App\Models\PaymentMethod\PaymentMethod;
use App\Models\Period\Period;
use App\Models\Supplier\Supplier;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $description = $request->query('description');
        $finances = [
            'items' => Finance::where('description', 'like', '%' . $description . '%')->with(['period', 'paymentMethod'])->paginate(5),
            'total' => Finance::count(),
            'total_paid' => Finance::where('is_paid', true)->count()
        ];
        $paymentMethods = PaymentMethod::where('is_active', True)->get();
        return Inertia::render('finance/Index', compact('finances', 'paymentMethods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::where('is_active', True)->get();
        $paymentMethods = PaymentMethod::where('is_active', True)->get();
        $periods = Period::where('is_active', True)->get();
        return Inertia::render('finance/Create', compact('suppliers', 'paymentMethods', 'periods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountRequest $request)
    {
        $supplier = Supplier::find($request->supplier_id);
        $payment_method = PaymentMethod::find($request->payment_method_id);
        $period = Period::find($request->period_id);

        $finance = new Finance([
            'account_plan' => $request->account_plan,
            'description' => $request->description,
            'category' => $request->category,
            'due_date' => $request->due_date,
            'amount' => $request->amount,
            'date_of_issue' => $request->date_of_issue,
            'observation' => $request->observation,
            'is_paid' => $request->is_paid
        ]);

        $finance->supplier()->associate($supplier);
        $finance->paymentMethod()->associate($payment_method);
        $finance->period()->associate($period);
        $finance->save();

        return redirect()->route('finances.index')->with('success', 'Cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Finance $finance)
    {
        $finance = Finance::where('id', $finance->id)->with(['supplier', 'period', 'paymentMethod'])->first();
        return Inertia::render('finance/Show', compact('finance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Finance $finance)
    {
        $suppliers = Supplier::where('is_active', True)->get();
        $paymentMethods = PaymentMethod::where('is_active', True)->get();
        $periods = Period::where('is_active', True)->get();
        return Inertia::render('finance/Edit', compact('finance', 'suppliers', 'paymentMethods', 'periods'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountRequest $request, Finance $finance)
    {
        $finance->supplier_id = $request->input('supplier');
        $finance->payment_method_id = $request->input('payment_method');
        $finance->period_id = $request->input('period');

        $finance->account_plan = $request->input('account_plan');
        $finance->description = $request->input('description');
        $finance->category = $request->input('category');
        $finance->due_date = $request->input('due_date');
        $finance->amount = $request->input('amount');
        $finance->date_of_issue = $request->input('date_of_issue');
        $finance->observation = $request->input('observation');
        $finance->is_paid = $request->input('is_paid');
        $finance->save();

        return redirect()->route('finances.index')->with('success', 'Actualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Finance $finance)
    {
        $finance->delete();
        return redirect()->route('finances.index')->with('success', 'Deleted com sucesso!');
    }
}
