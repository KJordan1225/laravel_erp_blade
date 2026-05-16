<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\InventoryAdjustment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'vendor'])
            ->orderBy('name')
            ->paginate(10);

        $adjustments = InventoryAdjustment::with('product')
            ->latest()
            ->take(15)
            ->get();

        return view('inventory.index', compact('products', 'adjustments'));
    }

    public function create()
    {
        $products = Product::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('inventory.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'type' => ['required', 'in:increase,decrease'],
            'quantity' => ['required', 'integer', 'min:1'],
            'reason' => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($data) {
            $product = Product::findOrFail($data['product_id']);

            if ($data['type'] === 'increase') {
                $product->quantity += $data['quantity'];
            } else {
                $product->quantity -= $data['quantity'];

                if ($product->quantity < 0) {
                    $product->quantity = 0;
                }
            }

            $product->save();

            InventoryAdjustment::create($data);
        });

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Inventory adjusted successfully.');
    }
}
