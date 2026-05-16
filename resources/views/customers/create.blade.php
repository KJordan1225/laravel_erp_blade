@extends('layouts.app')

@section('title', 'Add Customer - Blue Orange ERP')
@section('page_title', 'Add Customer')
@section('page_subtitle', 'Create a new customer record')

@section('content')
<div class="erp-card">
    <div class="p-3 border-bottom">
        <h5 class="mb-0 text-primary fw-bold">Customer Information</h5>
    </div>

    <div class="p-4">
        <form method="POST" action="{{ route('customers.store') }}">
            @csrf

            @include('customers.partials.form', ['customer' => null])

            <div class="mt-4">
                <button class="btn btn-orange" type="submit">
                    <i class="bi bi-save me-1"></i>
                    Save Customer
                </button>

                <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
