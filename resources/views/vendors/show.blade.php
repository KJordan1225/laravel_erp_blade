@extends('layouts.app')

@section('title', 'View Vendor - Blue Orange ERP')
@section('page_title', 'View Vendor')
@section('page_subtitle', 'Vendor details and activity')

@section('content')
<div class="row g-4">
    <div class="col-lg-5">
        <div class="erp-card">
            <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-primary fw-bold">Vendor Details</h5>

                <a href="{{ route('vendors.edit', $vendor) }}" class="btn btn-sm btn-orange">
                    Edit
                </a>
            </div>

            <div class="p-4">
                <p><strong>Name:</strong> {{ $vendor->name }}</p>
                <p><strong>Contact Person:</strong> {{ $vendor->contact_person ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $vendor->email ?? 'N/A' }}</p>
                <p><strong>Phone:</strong> {{ $vendor->phone ?? 'N/A' }}</p>
                <p>
                    <strong>Status:</strong>
                    <span class="status-badge status-{{ $vendor->status }}">
                        {{ $vendor->status }}
                    </span>
                </p>

                <hr>

                <p><strong>Address:</strong></p>
                <p>{{ $vendor->address ?? 'N/A' }}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="erp-card mb-4">
            <div class="p-3 border-bottom">
                <h5 class="mb-0 text-primary fw-bold">Products</h5>
            </div>

            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>SKU</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($vendor->products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->quantity }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">
                                    No products found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="erp-card">
            <div class="p-3 border-bottom">
                <h5 class="mb-0 text-primary fw-bold">Purchase Orders</h5>
            </div>

            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>PO Number</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($vendor->purchaseOrders as $order)
                            <tr>
                                <td>{{ $order->purchase_order_number }}</td>
                                <td>{{ optional($order->purchase_order_date)->format('m/d/Y') }}</td>
                                <td>${{ number_format($order->total, 2) }}</td>
                                <td>
                                    <span class="status-badge status-{{ $order->status }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    No purchase orders found.
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
