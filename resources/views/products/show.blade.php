@extends('layouts.app')

@section('title', 'View Product - Blue Orange ERP')
@section('page_title', 'View Product')
@section('page_subtitle', 'Product details and inventory history')

@section('content')
<div class="row g-4">
    <div class="col-lg-5">
        <div class="erp-card">
            <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-primary fw-bold">Product Details</h5>

                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-orange">
                    Edit
                </a>
            </div>

            <div class="p-4">
                <p><strong>Name:</strong> {{ $product->name }}</p>
                <p><strong>SKU:</strong> {{ $product->sku }}</p>
                <p><strong>Category:</strong> {{ $product->category->name ?? 'N/A' }}</p>
                <p><strong>Vendor:</strong> {{ $product->vendor->name ?? 'N/A' }}</p>
                <p><strong>Cost Price:</strong> ${{ number_format($product->cost_price, 2) }}</p>
                <p><strong>Selling Price:</strong> ${{ number_format($product->selling_price, 2) }}</p>
                <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
                <p><strong>Reorder Level:</strong> {{ $product->reorder_level }}</p>

                <p>
                    <strong>Stock Status:</strong>
                    @if($product->quantity <= $product->reorder_level)
                        <span class="status-badge status-overdue">Low Stock</span>
                    @else
                        <span class="status-badge status-active">OK</span>
                    @endif
                </p>

                <p>
                    <strong>Status:</strong>
                    <span class="status-badge status-{{ $product->status }}">
                        {{ $product->status }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="erp-card">
            <div class="p-3 border-bottom">
                <h5 class="mb-0 text-primary fw-bold">Inventory Adjustments</h5>
            </div>

            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>Reason</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($product->inventoryAdjustments as $adjustment)
                            <tr>
                                <td>{{ $adjustment->created_at->format('m/d/Y') }}</td>
                                <td>{{ ucfirst($adjustment->type) }}</td>
                                <td>{{ $adjustment->quantity }}</td>
                                <td>{{ $adjustment->reason ?? 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    No inventory adjustments found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
