@extends('layouts.app')

@section('title', 'Edit Payment - Blue Orange ERP')
@section('page_title', 'Edit Payment')
@section('page_subtitle', 'Update payment record')

@section('content')
<div class="erp-card">
    <div class="p-3 border-bottom">
        <h5 class="mb-0 text-primary fw-bold">Payment Information</h5>
    </div>

    <div class="p-4">
        <form method="POST" action="{{ route('payments.update', $payment) }}">
            @csrf
            @method('PUT')

            @include('payments.partials.form', [
                'payment' => $payment,
                'invoices' => $invoices,
                'selectedInvoice' => null,
            ])

            <div class="mt-4">
                <button class="btn btn-orange" type="submit">
                    Update Payment
                </button>

                <a href="{{ route('payments.index') }}" class="btn btn-outline-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
