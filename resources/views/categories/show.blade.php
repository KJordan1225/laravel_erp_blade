@extends('layouts.app')

@section('title', 'View Category - Blue Orange ERP')
@section('page_title', 'View Category')
@section('page_subtitle', 'Category details and products')

@section('content')
<div class="erp-card mb-4">
    <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-primary fw-bold">Category Details</h5>

        <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-orange">
            Edit
        </a>
    </div>

    <div class="p-4">
        <p><strong>Name:</strong> {{ $category->name }}</p>
        <p><strong>Description:</strong> {{ $category->description ?? 'N/A' }}</p>
        <p>
            <strong>Status:</strong>
            <span class="status-badge status-{{ $category->status }}">
                {{ $category->status }}
            </span>
        </p>
    </div>
</div>

<div class="erp-card">
    <div class="p-3 border-bottom">
        <h5 class="mb-0 text-primary fw-bold">Products in this Category</h5>
    </div>

    <div class="table-responsive">
        <table class="table mb-0 align-middle">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Quantity</th>
                    <th>Selling Price</th>
                </tr>
            </thead>

            <tbody>
                @forelse($category->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>${{ number_format($product->selling_price, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            No products found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
