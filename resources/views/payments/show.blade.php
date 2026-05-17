@extends('layouts.app')

@section('title', 'View Payment - Blue Orange ERP')
@section('page_title', 'View Payment')
@section('page_subtitle', 'Payment details')

@section('content')
<div class="erp-card">
    <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-primary fw-bold">Payment #{{ $payment->id }}</h5>

        <a href="{{ route('payments.edit', $payment) }}" class="btn btn-sm btn-orange">
            Edit
        </a>
    </div>

    <div class="p-4 row g-3">
        <div class="col-md-6">
            <strong>Invoice:</strong>
            <div>{{ $payment->invoice->invoice_number ?? 'N/A' }}</div>
        </div>

        <div class="col-md-6">
            <strong>Customer:</strong>
            <div>{{ $payment->invoice->customer->name ?? 'N/A' }}</div>
        </div>

        <div class="col-md-6">
            <strong>Payment Date:</strong>
            <div>{{ optional($payment->payment_date)->format('m/d/Y') }}</div>
        </div>

        <div class="col-md-6">
            <strong>Amount:</strong>
            <div>${{ number_format($payment->amount, 2) }}</div>
        </div>

        <div class="col-md-6">
            <strong>Method:</strong>
            <div>{{ ucwords(str_replace('_', ' ', $payment->method)) }}</div>
        </div>

        <div class="col-md-6">
            <strong>Reference:</strong>
            <div>{{ $payment->reference_number ?? 'N/A' }}</div>
        </div>

        <div class="col-md-12">
            <strong>Notes:</strong>
            <div>{{ $payment->notes ?? 'N/A' }}</div>
        </div>
    </div>
</div>
@endsection
