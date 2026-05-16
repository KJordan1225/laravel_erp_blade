@extends('layouts.app')

@section('title', 'View Customer - Blue Orange ERP')
@section('page_title', 'View Customer')
@section('page_subtitle', 'Customer details and activity')

@section('content')
<div class="row g-4">
    <div class="col-lg-5">
        <div class="erp-card">
            <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-primary fw-bold">Customer Details</h5>

                <a href="{{ route('customers.edit', $customer) }}" class="btn btn-sm btn-orange">
                    Edit
                </a>
            </div>

            <div class="p-4">
                <p><strong>Name:</strong> {{ $customer->name }}</p>
                <p><strong>Company:</strong> {{ $customer->company ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $customer->email ?? 'N/A' }}</p>
                <p><strong>Phone:</strong> {{ $customer->phone ?? 'N/A' }}</p>
                <p>
                    <strong>Status:</strong>
                    <span class="status-badge status-{{ $customer->status }}">
                        {{ $customer->status }}
                    </span>
                </p>

                <hr>

                <p><strong>Billing Address:</strong></p>
                <p>{{ $customer->billing_address ?? 'N/A' }}</p>

                <p><strong>Shipping Address:</strong></p>
                <p>{{ $customer->shipping_address ?? 'N/A' }}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="erp-card mb-4">
            <div class="p-3 border-bottom">
                <h5 class="mb-0 text-primary fw-bold">Recent Invoices</h5>
            </div>

            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($customer->invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->invoice_number }}</td>
                                <td>{{ optional($invoice->invoice_date)->format('m/d/Y') }}</td>
                                <td>${{ number_format($invoice->total, 2) }}</td>
                                <td>
                                    <span class="status-badge status-{{ $invoice->status }}">
                                        {{ $invoice->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    No invoices found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="erp-card">
            <div class="p-3 border-bottom">
                <h5 class="mb-0 text-primary fw-bold">Sales Orders</h5>
            </div>

            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($customer->salesOrders as $order)
                            <tr>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ optional($order->order_date)->format('m/d/Y') }}</td>
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
                                    No sales orders found.
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
