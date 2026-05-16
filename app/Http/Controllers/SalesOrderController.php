<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesOrderController extends Controller
{
    public function index()
    {
        $salesOrders = SalesOrder::with('customer')
            ->latest()
            ->paginate(10);

        return view('sales-orders.index', compact('salesOrders'));
    }

    public function create()
    {
        $customers = Customer::where('status', 'active')->orderBy('name')->get();
        $products = Product::where('status', 'active')->orderBy('name')->get();

        return view('sales-orders.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'order_date' => ['required', 'date'],
            'tax' => ['nullable', 'numeric', 'min:0'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', 'in:draft,confirmed,shipped,cancelled'],

            'product_id' => ['required', 'array'],
            'product_id.*' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'array'],
            'quantity.*' => ['required', 'integer', 'min:1'],
            'unit_price' => ['required', 'array'],
            'unit_price.*' => ['required', 'numeric', 'min:0'],
        ]);

        DB::transaction(function () use ($data, &$salesOrder) {
            $subtotal = 0;

            foreach ($data['product_id'] as $index => $productId) {
                $subtotal += $data['quantity'][$index] * $data['unit_price'][$index];
            }

            $tax = $data['tax'] ?? 0;
            $discount = $data['discount'] ?? 0;
            $total = $subtotal + $tax - $discount;

            $salesOrder = SalesOrder::create([
                'customer_id' => $data['customer_id'],
                'order_number' => 'SO-' . now()->format('YmdHis'),
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

                $salesOrder->items()->create([
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'line_total' => $quantity * $unitPrice,
                ]);
            }
        });

        return redirect()
            ->route('sales-orders.show', $salesOrder)
            ->with('success', 'Sales order created successfully.');
    }

    public function show(SalesOrder $salesOrder)
    {
        $salesOrder->load(['customer', 'items.product']);

        return view('sales-orders.show', compact('salesOrder'));
    }

    public function edit(SalesOrder $salesOrder)
    {
        $salesOrder->load('items');

        $customers = Customer::orderBy('name')->get();
        $products = Product::orderBy('name')->get();

        return view('sales-orders.edit', compact('salesOrder', 'customers', 'products'));
    }

    public function update(Request $request, SalesOrder $salesOrder)
    {
        $data = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'order_date' => ['required', 'date'],
            'tax' => ['nullable', 'numeric', 'min:0'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', 'in:draft,confirmed,shipped,cancelled'],

            'product_id' => ['required', 'array'],
            'product_id.*' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'array'],
            'quantity.*' => ['required', 'integer', 'min:1'],
            'unit_price' => ['required', 'array'],
            'unit_price.*' => ['required', 'numeric', 'min:0'],
        ]);

        DB::transaction(function () use ($data, $salesOrder) {
            $subtotal = 0;

            foreach ($data['product_id'] as $index => $productId) {
                $subtotal += $data['quantity'][$index] * $data['unit_price'][$index];
            }

            $tax = $data['tax'] ?? 0;
            $discount = $data['discount'] ?? 0;
            $total = $subtotal + $tax - $discount;

            $salesOrder->update([
                'customer_id' => $data['customer_id'],
                'order_date' => $data['order_date'],
                'subtotal' => $subtotal,
                'tax' => $tax,
                'discount' => $discount,
                'total' => $total,
                'status' => $data['status'],
            ]);

            $salesOrder->items()->delete();

            foreach ($data['product_id'] as $index => $productId) {
                $quantity = $data['quantity'][$index];
                $unitPrice = $data['unit_price'][$index];

                $salesOrder->items()->create([
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'line_total' => $quantity * $unitPrice,
                ]);
            }
        });

        return redirect()
            ->route('sales-orders.show', $salesOrder)
            ->with('success', 'Sales order updated successfully.');
    }

    public function destroy(SalesOrder $salesOrder)
    {
        $salesOrder->delete();

        return redirect()
            ->route('sales-orders.index')
            ->with('success', 'Sales order deleted successfully.');
    }
}
