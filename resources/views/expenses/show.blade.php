@extends('layouts.app')

@section('title', 'View Expense - Blue Orange ERP')
@section('page_title', 'View Expense')
@section('page_subtitle', 'Expense details')

@section('content')
<div class="erp-card">
    <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-primary fw-bold">{{ $expense->title }}</h5>

        <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-sm btn-orange">
            Edit
        </a>
    </div>

    <div class="p-4 row g-3">
        <div class="col-md-6">
            <strong>Vendor:</strong>
            <div>{{ $expense->vendor->name ?? 'N/A' }}</div>
        </div>

        <div class="col-md-6">
            <strong>Category:</strong>
            <div>{{ $expense->category ?? 'N/A' }}</div>
        </div>

        <div class="col-md-6">
            <strong>Expense Date:</strong>
            <div>{{ optional($expense->expense_date)->format('m/d/Y') }}</div>
        </div>

        <div class="col-md-6">
            <strong>Amount:</strong>
            <div>${{ number_format($expense->amount, 2) }}</div>
        </div>

        <div class="col-md-6">
            <strong>Payment Method:</strong>
            <div>{{ ucwords(str_replace('_', ' ', $expense->payment_method)) }}</div>
        </div>

        <div class="col-md-12">
            <strong>Notes:</strong>
            <div>{{ $expense->notes ?? 'N/A' }}</div>
        </div>
    </div>
</div>
@endsection
