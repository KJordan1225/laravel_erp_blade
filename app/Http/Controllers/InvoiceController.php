<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('customer')
            ->latest()
            ->paginate(10);

        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $customers = Customer::where('status', 'active')->orderBy('name')->get();
        $products = Product::where('status', 'active')->orderBy('name')->get();

        return view('invoices.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'order_date' => ['required', 'date'],
            'tax' => ['nullable', 'numeric', 'min:0'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', 'in:draft, sent, paid, overdue, cancelled'],

            'product_id' => ['required', 'array'],
            'product_id.*' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'array'],
            'quantity.*' => ['required', 'integer', 'min:1'],
            'unit_price' => ['required', 'array'],
            'unit_price.*' => ['required', 'numeric', 'min:0'],
        ]);

        DB::transaction(function () use ($data, &$invoice) {
            $subtotal = 0;

            foreach ($data['product_id'] as $index => $productId) {
                $subtotal += $data['quantity'][$index] * $data['unit_price'][$index];
            }

            $tax = $data['tax'] ?? 0;
            $discount = $data['discount'] ?? 0;
            $total = $subtotal + $tax - $discount;

            $invoice = Invoice::create([
                'customer_id' => $data['customer_id'],
                'invoice_number' => 'SO-' . now()->format('YmdHis'),
                'order_date' => $data['order_date'],
                'subtotal' => $subtotal,
                'tax' => $tax,
                'discount' => $discount,
                'total' => $total,
                'status' => $data['status'],
            ]);

            foreach ($data['product_id'] as $index => $productId) {
                $quantity = $data['quantity'][$index];
                $unitPrice = $data['unit_price'][$index];

                $invoice->items()->create([
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'line_total' => $quantity * $unitPrice,
                ]);
            }
        });

        return redirect()
            ->route('invoices.show', $invoice)
            ->with('success', 'Sales order created successfully.');
    }

    public function show(Invoice$invoice)
    {
        $invoice->load(['customer', 'items.product']);

        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice$invoice)
    {
        $invoice->load('items');

        $customers = Customer::orderBy('name')->get();
        $products = Product::orderBy('name')->get();

        return view('invoices.edit', compact('invoice', 'customers', 'products'));
    }

    public function update(Request $request, Invoice$invoice)
    {
        $data = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'order_date' => ['required', 'date'],
            'tax' => ['nullable', 'numeric', 'min:0'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', 'in:draft, sent, paid, overdue, cancelled'],

            'product_id' => ['required', 'array'],
            'product_id.*' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'array'],
            'quantity.*' => ['required', 'integer', 'min:1'],
            'unit_price' => ['required', 'array'],
            'unit_price.*' => ['required', 'numeric', 'min:0'],
        ]);

        DB::transaction(function () use ($data, $invoice) {
            $subtotal = 0;

            foreach ($data['product_id'] as $index => $productId) {
                $subtotal += $data['quantity'][$index] * $data['unit_price'][$index];
            }

            $tax = $data['tax'] ?? 0;
            $discount = $data['discount'] ?? 0;
            $total = $subtotal + $tax - $discount;

            $invoice->update([
                'customer_id' => $data['customer_id'],
                'order_date' => $data['order_date'],
                'subtotal' => $subtotal,
                'tax' => $tax,
                'discount' => $discount,
                'total' => $total,
                'status' => $data['status'],
            ]);

            $invoice->items()->delete();

            foreach ($data['product_id'] as $index => $productId) {
                $quantity = $data['quantity'][$index];
                $unitPrice = $data['unit_price'][$index];

                $invoice->items()->create([
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'line_total' => $quantity * $unitPrice,
                ]);
            }
        });

        return redirect()
            ->route('invoices.show', $invoice)
            ->with('success', 'Sales order updated successfully.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()
            ->route('invoices.index')
            ->with('success', 'Sales order deleted successfully.');
    }
}
