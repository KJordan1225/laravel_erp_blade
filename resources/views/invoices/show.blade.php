@extends('layouts.app')

@section('title', 'View Invoice - Blue Orange ERP')
@section('page_title', 'View Invoice')
@section('page_subtitle', 'Invoice details')

@section('content')
<div class="erp-card mb-4">
    <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-primary fw-bold">{{ $invoice->invoice_number }}</h5>

        <a href="{{ route('invoices.edit', $invoice) }}" class="btn btn-sm btn-orange">
            Edit
        </a>
    </div>

    <div class="p-4 row g-3">
        <div class="col-md-4">
            <strong>Customer:</strong>
            <div>{{ $invoice->customer->name ?? 'N/A' }}</div>
        </div>

        <div class="col-md-4">
            <strong>Order Date:</strong>
            <div>{{ optional($invoice->order_date)->format('m/d/Y') }}</div>
        </div>

        <div class="col-md-4">
            <strong>Status:</strong>
            <div>
                <span class="status-badge status-{{ $invoice->status }}">
                    {{ $invoice->status }}
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
                @foreach($invoice->items as $item)
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
                    <th>${{ number_format($invoice->subtotal, 2) }}</th>
                </tr>
                <tr>
                    <th colspan="3" class="text-end">Tax</th>
                    <th>${{ number_format($invoice->tax, 2) }}</th>
                </tr>
                <tr>
                    <th colspan="3" class="text-end">Discount</th>
                    <th>${{ number_format($invoice->discount, 2) }}</th>
                </tr>
                <tr>
                    <th colspan="3" class="text-end">Total</th>
                    <th>${{ number_format($invoice->total, 2) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection