@extends('layouts.app')

@section('title', 'Reports - Blue Orange ERP')
@section('page_title', 'Reports')
@section('page_subtitle', 'Financial and operational summary')

@section('content')
<div class="row g-4">
    <div class="col-md-6 col-xl-3">
        <div class="erp-card stat-card">
            <div class="stat-label">Total Sales</div>
            <div class="stat-value">${{ number_format($totalSales, 2) }}</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="erp-card stat-card orange">
            <div class="stat-label">Total Purchases</div>
            <div class="stat-value">${{ number_format($totalPurchases, 2) }}</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="erp-card stat-card">
            <div class="stat-label">Payments Received</div>
            <div class="stat-value">${{ number_format($totalPayments, 2) }}</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="erp-card stat-card orange">
            <div class="stat-label">Expenses</div>
            <div class="stat-value">${{ number_format($totalExpenses, 2) }}</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="erp-card stat-card">
            <div class="stat-label">Accounts Receivable</div>
            <div class="stat-value">${{ number_format($accountsReceivable, 2) }}</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="erp-card stat-card orange">
            <div class="stat-label">Customers</div>
            <div class="stat-value">{{ $customerCount }}</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="erp-card stat-card">
            <div class="stat-label">Products</div>
            <div class="stat-value">{{ $productCount }}</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="erp-card stat-card orange">
            <div class="stat-label">Low Stock Items</div>
            <div class="stat-value">{{ $lowStockCount }}</div>
        </div>
    </div>
</div>

<div class="row g-4 mt-1">
    <div class="col-lg-7">
        <div class="erp-card">
            <div class="p-3 border-bottom">
                <h5 class="mb-0 text-primary fw-bold">Recent Invoices</h5>
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Balance</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($recentInvoices as $invoice)
                            <tr>
                                <td>{{ $invoice->invoice_number }}</td>
                                <td>{{ $invoice->customer->name ?? 'N/A' }}</td>
                                <td>${{ number_format($invoice->total, 2) }}</td>
                                <td>${{ number_format($invoice->balance_due, 2) }}</td>
                                <td>
                                    <span class="status-badge status-{{ $invoice->status }}">
                                        {{ $invoice->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    No invoices found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="erp-card">
            <div class="p-3 border-bottom">
                <h5 class="mb-0 text-primary fw-bold">Low Stock Products</h5>
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Reorder</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($lowStockProducts as $product)
                            <tr>
                                <td class="fw-bold">{{ $product->name }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->reorder_level }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">
                                    No low stock products.
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
