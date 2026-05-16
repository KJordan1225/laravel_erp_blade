@extends('layouts.app')

@section('title', 'Sales Orders - Blue Orange ERP')
@section('page_title', 'Sales Orders')
@section('page_subtitle', 'Manage customer sales orders')

@section('content')
<div class="erp-card">
    <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-primary fw-bold">Sales Order List</h5>

        <a href="{{ route('sales-orders.create') }}" class="btn btn-orange">
            <i class="bi bi-plus-circle me-1"></i>
            Add Sales Order
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th width="220">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($salesOrders as $order)
                    <tr>
                        <td class="fw-bold">{{ $order->order_number }}</td>
                        <td>{{ $order->customer->name ?? 'N/A' }}</td>
                        <td>{{ optional($order->order_date)->format('m/d/Y') }}</td>
                        <td>${{ number_format($order->total, 2) }}</td>
                        <td>
                            <span class="status-badge status-{{ $order->status }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('sales-orders.show', $order) }}" class="btn btn-sm btn-outline-primary">
                                    View
                                </a>

                                <a href="{{ route('sales-orders.edit', $order) }}" class="btn btn-sm btn-outline-secondary">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('sales-orders.destroy', $order) }}" class="delete-form">
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
                        <td colspan="6" class="text-center text-muted py-4">
                            No sales orders found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-3">
        {{ $salesOrders->links() }}
    </div>
</div>
@endsection
