@extends('layouts.app')

@section('title', 'Payments - Blue Orange ERP')
@section('page_title', 'Payments')
@section('page_subtitle', 'Manage invoice payments')

@section('content')
<div class="erp-card">
    <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-primary fw-bold">Payment List</h5>

        <a href="{{ route('payments.create') }}" class="btn btn-orange">
            <i class="bi bi-plus-circle me-1"></i>
            Add Payment
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Invoice</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Method</th>
                    <th>Reference</th>
                    <th>Amount</th>
                    <th width="220">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($payments as $payment)
                    <tr>
                        <td class="fw-bold">{{ $payment->invoice->invoice_number ?? 'N/A' }}</td>
                        <td>{{ $payment->invoice->customer->name ?? 'N/A' }}</td>
                        <td>{{ optional($payment->payment_date)->format('m/d/Y') }}</td>
                        <td>{{ str_replace('_', ' ', ucfirst($payment->method)) }}</td>
                        <td>{{ $payment->reference_number ?? 'N/A' }}</td>
                        <td>${{ number_format($payment->amount, 2) }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('payments.show', $payment) }}" class="btn btn-sm btn-outline-primary">
                                    View
                                </a>

                                <a href="{{ route('payments.edit', $payment) }}" class="btn btn-sm btn-outline-secondary">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('payments.destroy', $payment) }}" class="delete-form">
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
                        <td colspan="7" class="text-center text-muted py-4">
                            No payments found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-3">
        {{ $payments->links() }}
    </div>
</div>
@endsection
