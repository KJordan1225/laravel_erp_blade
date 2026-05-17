@extends('layouts.app')

@section('title', 'Add Expense - Blue Orange ERP')
@section('page_title', 'Add Expense')
@section('page_subtitle', 'Create a business expense')

@section('content')
<div class="erp-card">
    <div class="p-3 border-bottom">
        <h5 class="mb-0 text-primary fw-bold">Expense Information</h5>
    </div>

    <div class="p-4">
        <form method="POST" action="{{ route('expenses.store') }}">
            @csrf

            @include('expenses.partials.form', [
                'expense' => null,
                'vendors' => $vendors,
            ])

            <div class="mt-4">
                <button class="btn btn-orange" type="submit">
                    Save Expense
                </button>

                <a href="{{ route('expenses.index') }}" class="btn btn-outline-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
