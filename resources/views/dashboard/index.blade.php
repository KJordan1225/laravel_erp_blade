@extends('layouts.app')

@section('title', 'Dashboard - Blue Orange ERP')
@section('page_title', 'Dashboard')
@section('page_subtitle', 'Business overview and ERP summary')

@section('content')
<div class="row g-4">
    <div class="col-md-6 col-xl-3">
        <div class="erp-card stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-label">Customers</div>
                    <div class="stat-value">{{ $totalCustomers }}</div>
                </div>
                <div class="stat-icon">
                    <i class="bi bi-people"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="erp-card stat-card orange">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-label">Vendors</div>
                    <div class="stat-value">{{ $totalVendors }}</div>
                </div>
                <div class="stat-icon orange">
                    <i class="bi bi-truck"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="erp-card stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-label">Products</div>
                    <div class="stat-value">{{ $totalProducts }}</div>
                </div>
                <div class="stat-icon">
                    <i class="bi bi-box-seam"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="erp-card stat-card orange">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-label">Low Stock</div>
                    <div class="stat-value">{{ $lowStockProducts }}</div>
                </div>
                <div class="stat-icon orange">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="erp-card stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-label">Sales Orders</div>
                    <div class="stat-value">${{ number_format($totalSales, 2) }}</div>
                </div>
                <div class="stat-icon">
                    <i class="bi bi-cart-check"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="erp-card stat-card orange">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-label">Purchases</div>
                    <div class="stat-value">${{ number_format($totalPurchases, 2) }}</div>
                </div>
                <div class="stat-icon orange">
                    <i class="bi bi-bag-check"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="erp-card stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-label">Payments</div>
                    <div class="stat-value">${{ number_format($totalPayments, 2) }}</div>
                </div>
                <div class="stat-icon">
                    <i class="bi bi-credit-card"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="erp-card stat-card orange">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-label">Expenses</div>
                    <div class="stat-value">${{ number_format($totalExpenses, 2) }}</div>
                </div>
                <div class="stat-icon orange">
                    <i class="bi bi-cash-stack"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-1">
    <div class="col-lg-7">
        <div class="erp-card">
            <div class="p-3 border-bottom d-flex align-items-center justify-content-between">
                <h5 class="mb-0 text-primary fw-bold">Recent Invoices</h5>
                <a href="{{ route('invoices.index') }}" class="btn btn-sm btn-orange">View All</a>
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentInvoices as $invoice)
                            <tr>
                                <td>{{ $invoice->invoice_number }}</td>
                                <td>{{ $invoice->customer->name ?? 'N/A' }}</td>
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
    </div>

    <div class="col-lg-5">
        <div class="erp-card">
            <div class="p-3 border-bottom d-flex align-items-center justify-content-between">
                <h5 class="mb-0 text-primary fw-bold">Recent Products</h5>
                <a href="{{ route('products.index') }}" class="btn btn-sm btn-orange">View All</a>
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentProducts as $product)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $product->name }}</div>
                                    <small class="text-muted">{{ $product->sku }}</small>
                                </td>
                                <td>{{ $product->quantity }}</td>
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
                                <td colspan="3" class="text-center text-muted py-4">
                                    No products found.
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
