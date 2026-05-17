@extends('layouts.app')

@section('title', 'Expenses - Blue Orange ERP')
@section('page_title', 'Expenses')
@section('page_subtitle', 'Manage business expenses')

@section('content')
<div class="erp-card">
    <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-primary fw-bold">Expense List</h5>

        <a href="{{ route('expenses.create') }}" class="btn btn-orange">
            <i class="bi bi-plus-circle me-1"></i>
            Add Expense
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Vendor</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Method</th>
                    <th>Amount</th>
                    <th width="220">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($expenses as $expense)
                    <tr>
                        <td class="fw-bold">{{ $expense->title }}</td>
                        <td>{{ $expense->vendor->name ?? 'N/A' }}</td>
                        <td>{{ $expense->category ?? 'N/A' }}</td>
                        <td>{{ optional($expense->expense_date)->format('m/d/Y') }}</td>
                        <td>{{ ucwords(str_replace('_', ' ', $expense->payment_method)) }}</td>
                        <td>${{ number_format($expense->amount, 2) }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('expenses.show', $expense) }}" class="btn btn-sm btn-outline-primary">
                                    View
                                </a>

                                <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-sm btn-outline-secondary">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('expenses.destroy', $expense) }}" class="delete-form">
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
                            No expenses found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-3">
        {{ $expenses->links() }}
    </div>
</div>
@endsection
