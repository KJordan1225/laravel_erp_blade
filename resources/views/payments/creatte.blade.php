@extends('layouts.app')

@section('title', 'Add Payment - Blue Orange ERP')
@section('page_title', 'Add Payment')
@section('page_subtitle', 'Record an invoice payment')

@section('content')
<div class="erp-card">
    <div class="p-3 border-bottom">
        <h5 class="mb-0 text-primary fw-bold">Payment Information</h5>
    </div>

    <div class="p-4">
        <form method="POST" action="{{ route('payments.store') }}">
            @csrf

            @include('payments.partials.form', [
                'payment' => null,
                'invoices' => $invoices,
                'selectedInvoice' => $selectedInvoice,
            ])

            <div class="mt-4">
                <button class="btn btn-orange" type="submit">
                    Save Payment
                </button>

                <a href="{{ route('payments.index') }}" class="btn btn-outline-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
