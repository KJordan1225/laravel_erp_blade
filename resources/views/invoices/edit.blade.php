@extends('layouts.app')

@section('title', 'Edit Invoice - Blue Orange ERP')
@section('page_title', 'Edit Invoice')
@section('page_subtitle', 'Update invoice')

@section('content')
<div class="erp-card">
    <div class="p-3 border-bottom">
        <h5 class="mb-0 text-primary fw-bold">Invoice Information</h5>
    </div>

    <div class="p-4">
        <form method="POST" action="{{ route('invoices.update', $invoice) }}">
            @csrf
            @method('PUT')

            @include('invoices.partials.form', [
                'invoice' => $invoice,
                'customers' => $customers,
                'products' => $products,
            ])

            <div class="mt-4">
                <button class="btn btn-orange" type="submit">
                    <i class="bi bi-save me-1"></i>
                    Update Invoice
                </button>

                <a href="{{ route('invoices.index') }}" class="btn btn-outline-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
