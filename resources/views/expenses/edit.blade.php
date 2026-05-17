@extends('layouts.app')

@section('title', 'Edit Expense - Blue Orange ERP')
@section('page_title', 'Edit Expense')
@section('page_subtitle', 'Update expense record')

@section('content')
<div class="erp-card">
    <div class="p-3 border-bottom">
        <h5 class="mb-0 text-primary fw-bold">Expense Information</h5>
    </div>

    <div class="p-4">
        <form method="POST" action="{{ route('expenses.update', $expense) }}">
            @csrf
            @method('PUT')

            @include('expenses.partials.form', [
                'expense' => $expense,
                'vendors' => $vendors,
            ])

            <div class="mt-4">
                <button class="btn btn-orange" type="submit">
                    Update Expense
                </button>

                <a href="{{ route('expenses.index') }}" class="btn btn-outline-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
