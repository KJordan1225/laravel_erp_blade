@extends('layouts.app')

@section('title', 'Edit Sales Order - Blue Orange ERP')
@section('page_title', 'Edit Sales Order')
@section('page_subtitle', 'Update sales order')

@section('content')
<div class="erp-card">
    <div class="p-3 border-bottom">
        <h5 class="mb-0 text-primary fw-bold">Sales Order Information</h5>
    </div>

    <div class="p-4">
        <form method="POST" action="{{ route('purchase-orders.update', $purchaseOrder) }}">
            @csrf
            @method('PUT')

            @include('purchase-orders.partials.form', [
                'purchaseOrder' => $purchaseOrder,
                'vendors' => $vendors,
                'products' => $products,
            ])

            <div class="mt-4">
                <button class="btn btn-orange" type="submit">
                    <i class="bi bi-save me-1"></i>
                    Update Sales Order
                </button>

                <a href="{{ route('purchase-orders.index') }}" class="btn btn-outline-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
