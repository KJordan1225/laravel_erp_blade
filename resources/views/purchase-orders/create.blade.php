@extends('layouts.app')

@section('title', 'Add Purchase Order - Blue Orange ERP')
@section('page_title', 'Add Purchase Order')
@section('page_subtitle', 'Create a customer purchase order')

@section('content')
<div class="erp-card">
    <div class="p-3 border-bottom">
        <h5 class="mb-0 text-primary fw-bold">Purchase Order Information</h5>
    </div>

    <div class="p-4">
        <form method="POST" action="{{ route('purchase-orders.store') }}">
            @csrf

            @include('purchase-orders.partials.form', [
                'purchaseOrder' => null,
                'vendors' => $vendors,
                'products' => $products,
            ])

            <div class="mt-4">
                <button class="btn btn-orange" type="submit">
                    <i class="bi bi-save me-1"></i>
                    Save Purchase Order
                </button>

                <a href="{{ route('purchase-orders.index') }}" class="btn btn-outline-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
