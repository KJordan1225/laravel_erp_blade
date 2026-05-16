@extends('layouts.app')

@section('title', 'Add Vendor - Blue Orange ERP')
@section('page_title', 'Add Vendor')
@section('page_subtitle', 'Create a new vendor record')

@section('content')
<div class="erp-card">
    <div class="p-3 border-bottom">
        <h5 class="mb-0 text-primary fw-bold">Vendor Information</h5>
    </div>

    <div class="p-4">
        <form method="POST" action="{{ route('vendors.store') }}">
            @csrf

            @include('vendors.partials.form', ['vendor' => null])

            <div class="mt-4">
                <button class="btn btn-orange" type="submit">
                    <i class="bi bi-save me-1"></i>
                    Save Vendor
                </button>

                <a href="{{ route('vendors.index') }}" class="btn btn-outline-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
