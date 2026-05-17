@extends('layouts.app')

@section('title', 'Add Invoice - Blue Orange ERP')
@section('page_title', 'Add Invoice')
@section('page_subtitle', 'Create a new invoice')

@section('content')
<div class="erp-card">
    <div class="p-3 border-bottom">
        <h5 class="mb-0 text-primary fw-bold">Invoice Information</h5>
    </div>

    <div class="p-4">
        <form method="POST" action="{{ route('invoices.store') }}">
            @csrf

            @include('invoices.partials.form', [
                'invoice' => null,
                'customers' => $customers,
                'products' => $products,
            ])

            <div class="mt-4">
                <button class="btn btn-orange" type="submit">
                    <i class="bi bi-save me-1"></i>
                    Save Invoice
                </button>

                <a href="{{ route('invoices.index') }}" class="btn btn-outline-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
