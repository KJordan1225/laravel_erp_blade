@extends('layouts.app')

@section('title', 'Products - Blue Orange ERP')
@section('page_title', 'Products')
@section('page_subtitle', 'Manage products and inventory items')

@section('content')
<div class="erp-card">
    <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-primary fw-bold">Product List</h5>

        <a href="{{ route('products.create') }}" class="btn btn-orange">
            <i class="bi bi-plus-circle me-1"></i>
            Add Product
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
                    <th>Price</th>
                    <th>Status</th>
                    <th width="220">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td class="fw-bold">
                            {{ $product->name }}

                            @if($product->quantity <= $product->reorder_level)
                                <div>
                                    <small class="text-danger">Low stock</small>
                                </div>
                            @endif
                        </td>
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                        <td>{{ $product->vendor->name ?? 'N/A' }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>${{ number_format($product->selling_price, 2) }}</td>
                        <td>
                            <span class="status-badge status-{{ $product->status }}">
                                {{ $product->status }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary">
                                    View
                                </a>

                                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-secondary">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('products.destroy', $product) }}" class="delete-form">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-outline-danger" type="submit">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
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
@endsection
