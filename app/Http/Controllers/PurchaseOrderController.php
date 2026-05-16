<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $purchaseOrders = PurchaseOrder::with('customer')
            ->latest()
            ->paginate(10);

        return view('purchase-orders.index', compact('purchaseOrders'));
    }

    public function create()
    {
        $vendors = Customer::where('status', 'active')->orderBy('name')->get();
        $products = Product::where('status', 'active')->orderBy('name')->get();

        return view('purchase-orders.create', compact('vendors', 'products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'vendor_id' => ['required', 'exists:vendors,id'],
            'purchase_order_date' => ['required', 'date'],
            'tax' => ['nullable', 'numeric', 'min:0'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', 'in:draft,confirmed,shipped,cancelled'],

            'product_id' => ['required', 'array'],
            'product_id.*' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'array'],
            'quantity.*' => ['required', 'integer', 'min:1'],
            'unit_cost' => ['required', 'array'],
            'unit_cost.*' => ['required', 'numeric', 'min:0'],
        ]);

        DB::transaction(function () use ($data, &$purchaseOrder) {
            $subtotal = 0;

            foreach ($data['product_id'] as $index => $productId) {
                $subtotal += $data['quantity'][$index] * $data['unit_cost'][$index];
            }

            $tax = $data['tax'] ?? 0;
            $discount = $data['discount'] ?? 0;
            $total = $subtotal + $tax - $discount;

            $purchaseOrder = PurchaseOrder::create([
                'vendor_id' => $data['vendor_id'],
                'purchase_order_number' => 'SO-' . now()->format('YmdHis'),
                'purchase_order_date' => $data['purchase_order_date'],
                'subtotal' => $subtotal,
                'tax' => $tax,
                'discount' => $discount,
                'total' => $total,
                'status' => $data['status'],
            ]);

            foreach ($data['product_id'] as $index => $productId) {
                $quantity = $data['quantity'][$index];
                $unitPrice = $data['unit_cost'][$index];

                $purchaseOrder->items()->create([
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'unit_cost' => $unitPrice,
                    'line_total' => $quantity * $unitPrice,
                ]);
            }
        });

        return redirect()
            ->route('purchase-orders.show', $purchaseOrder)
            ->with('success', 'Sales order created successfully.');
    }

    public function show(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->load(['customer', 'items.product']);

        return view('purchase-orders.show', compact('purchaseOrder'));
    }

    public function edit(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->load('items');

        $vendors = Customer::orderBy('name')->get();
        $products = Product::orderBy('name')->get();

        return view('purchase-orders.edit', compact('purchaseOrder', 'vendors', 'products'));
    }

    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        $data = $request->validate([
            'vendor_id' => ['required', 'exists:vendors,id'],
            'purchase_order_date' => ['required', 'date'],
            'tax' => ['nullable', 'numeric', 'min:0'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', 'in:draft,confirmed,shipped,cancelled'],

            'product_id' => ['required', 'array'],
            'product_id.*' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'array'],
            'quantity.*' => ['required', 'integer', 'min:1'],
            'unit_cost' => ['required', 'array'],
            'unit_cost.*' => ['required', 'numeric', 'min:0'],
        ]);

        DB::transaction(function () use ($data, $purchaseOrder) {
            $subtotal = 0;

            foreach ($data['product_id'] as $index => $productId) {
                $subtotal += $data['quantity'][$index] * $data['unit_cost'][$index];
            }

            $tax = $data['tax'] ?? 0;
            $discount = $data['discount'] ?? 0;
            $total = $subtotal + $tax - $discount;

            $purchaseOrder->update([
                'vendor_id' => $data['vendor_id'],
                'purchase_order_date' => $data['purchase_order_date'],
                'subtotal' => $subtotal,
                'tax' => $tax,
                'discount' => $discount,
                'total' => $total,
                'status' => $data['status'],
            ]);

            $purchaseOrder->items()->delete();

            foreach ($data['product_id'] as $index => $productId) {
                $quantity = $data['quantity'][$index];
                $unitPrice = $data['unit_cost'][$index];

                $purchaseOrder->items()->create([
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'unit_cost' => $unitPrice,
                    'line_total' => $quantity * $unitPrice,
                ]);
            }
        });

        return redirect()
            ->route('purchase-orders.show', $purchaseOrder)
            ->with('success', 'Sales order updated successfully.');
    }

    public function destroy(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->delete();

        return redirect()
            ->route('purchase-orders.index')
            ->with('success', 'Sales order deleted successfully.');
    }
}
