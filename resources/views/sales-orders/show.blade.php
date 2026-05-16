@extends('layouts.app')

@section('title', 'View Sales Order - Blue Orange ERP')
@section('page_title', 'View Sales Order')
@section('page_subtitle', 'Sales order details')

@section('content')
<div class="erp-card mb-4">
    <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-primary fw-bold">{{ $salesOrder->order_number }}</h5>

        <a href="{{ route('sales-orders.edit', $salesOrder) }}" class="btn btn-sm btn-orange">
            Edit
        </a>
    </div>

    <div class="p-4 row g-3">
        <div class="col-md-4">
            <strong>Customer:</strong>
            <div>{{ $salesOrder->customer->name ?? 'N/A' }}</div>
        </div>

        <div class="col-md-4">
            <strong>Order Date:</strong>
            <div>{{ optional($salesOrder->order_date)->format('m/d/Y') }}</div>
        </div>

        <div class="col-md-4">
            <strong>Status:</strong>
            <div>
                <span class="status-badge status-{{ $salesOrder->status }}">
                    {{ $salesOrder->status }}
                </span>
            </div>
        </div>
    </div>
</div>

<div class="erp-card">
    <div class="table-responsive">
        <table class="table mb-0 align-middle">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Line Total</th>
                </tr>
            </thead>

            <tbody>
                @foreach($salesOrder->items as $item)
                    <tr>
                        <td>{{ $item->product->name ?? 'N/A' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->unit_price, 2) }}</td>
                        <td>${{ number_format($item->line_total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <th colspan="3" class="text-end">Subtotal</th>
                    <th>${{ number_format($salesOrder->subtotal, 2) }}</th>
                </tr>
                <tr>
                    <th colspan="3" class="text-end">Tax</th>
                    <th>${{ number_format($salesOrder->tax, 2) }}</th>
                </tr>
                <tr>
                    <th colspan="3" class="text-end">Discount</th>
                    <th>${{ number_format($salesOrder->discount, 2) }}</th>
                </tr>
                <tr>
                    <th colspan="3" class="text-end">Total</th>
                    <th>${{ number_format($salesOrder->total, 2) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
