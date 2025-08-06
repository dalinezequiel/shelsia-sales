<?php

namespace App\Http\Controllers\Financial;

use App\Http\Controllers\Controller;
use App\Models\Financial\Account;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FinancialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::get();
        return Inertia::render('financial/Index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('financial/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'account_plan' => 'required',
            'description' => 'required'
        ]);

        Account::create([
            'account_plan' => $request -> account_plan,
            'description' => $request -> description,
            'category' => $request -> category,
            'supplier' => $request -> supplier,
            'due_date' => $request -> due_date,
            'amount' => $request -> amount,
            'date_of_issue' => $request -> date_of_issue,
            'document_number' => $request -> document_number,
            'occurrence' => $request -> occurrence,
            'observation' => $request -> observation,
            'is_active' => $request -> is_active
        ]);

        return redirect()->route('financial.index')->with('success', 'Cadastrado com sucesso!');
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
    public function edit(Account $financial)
    {
        return Inertia::render('financial/Edit', compact('financial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $financial)
    {
        $request->validate([
            'account_plan' => 'required',
            'description' => 'required'
        ]);

        $financial -> update([
            'account_plan' => $request -> input('account_plan'),
            'description' => $request -> input('description'),
            'category' => $request -> input('category'),
            'supplier' => $request -> input('supplier'),
            'due_date' => $request -> input('due_date'),
            'amount' => $request -> input('amount'),
            'date_of_issue' => $request -> input('date_of_issue'),
            'document_number' => $request -> input('document_number'),
            'occurrence' => $request -> input('occurrence'),
            'observation' => $request -> input('observation'),
            'is_active' => $request -> input('is_active')
        ]);

        return redirect()->route('financial.index')->with('success', 'Actualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $financial)
    {
        $financial -> delete();
        return redirect()->route('financial.index')->with('success', 'Deleted com sucesso!');
    }
}
