<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Vendor;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with('vendor')
            ->latest()
            ->paginate(10);

        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        $vendors = Vendor::orderBy('name')->get();

        return view('expenses.create', compact('vendors'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'vendor_id' => ['nullable', 'exists:vendors,id'],
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'expense_date' => ['required', 'date'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'payment_method' => ['required', 'in:cash,check,credit_card,bank_transfer,other'],
            'notes' => ['nullable', 'string'],
        ]);

        Expense::create($data);

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Expense created successfully.');
    }

    public function show(Expense $expense)
    {
        $expense->load('vendor');

        return view('expenses.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        $vendors = Vendor::orderBy('name')->get();

        return view('expenses.edit', compact('expense', 'vendors'));
    }

    public function update(Request $request, Expense $expense)
    {
        $data = $request->validate([
            'vendor_id' => ['nullable', 'exists:vendors,id'],
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'expense_date' => ['required', 'date'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'payment_method' => ['required', 'in:cash,check,credit_card,bank_transfer,other'],
            'notes' => ['nullable', 'string'],
        ]);

        $expense->update($data);

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Expense deleted successfully.');
    }
}
