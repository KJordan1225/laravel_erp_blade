@extends('layouts.app')

@section('title', 'Inventory - Blue Orange ERP')
@section('page_title', 'Inventory')
@section('page_subtitle', 'Monitor stock levels and inventory adjustments')

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="erp-card">
            <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-primary fw-bold">Stock Levels</h5>

                <a href="{{ route('inventory.create') }}" class="btn btn-orange">
                    <i class="bi bi-plus-circle me-1"></i>
                    Adjust Inventory
                </a>
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>SKU</th>
                            <th>Category</th>
                            <th>Vendor</th>
                            <th>Qty</th>
                            <th>Reorder</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td class="fw-bold">{{ $product->name }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->category->name ?? 'N/A' }}</td>
                                <td>{{ $product->vendor->name ?? 'N/A' }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->reorder_level }}</td>
                                <td>
                                    @if($product->quantity <= $product->reorder_level)
                                        <span class="status-badge status-overdue">Low Stock</span>
                                    @else
                                        <span class="status-badge status-active">OK</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    No products found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-3">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="erp-card">
            <div class="p-3 border-bottom">
                <h5 class="mb-0 text-primary fw-bold">Recent Adjustments</h5>
            </div>

            <div class="p-3">
                @forelse($adjustments as $adjustment)
                    <div class="border-bottom pb-2 mb-2">
                        <div class="fw-bold">{{ $adjustment->product->name ?? 'N/A' }}</div>
                        <div class="small text-muted">
                            {{ ucfirst($adjustment->type) }} by {{ $adjustment->quantity }}
                        </div>
                        <div class="small">
                            {{ $adjustment->reason ?? 'No reason provided' }}
                        </div>
                    </div>
                @empty
                    <div class="text-muted">No adjustments found.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
