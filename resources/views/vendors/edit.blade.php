@extends('layouts.app')

@section('title', 'Edit Vendor - Blue Orange ERP')
@section('page_title', 'Edit Vendor')
@section('page_subtitle', 'Update vendor information')

@section('content')
<div class="erp-card">
    <div class="p-3 border-bottom">
        <h5 class="mb-0 text-primary fw-bold">Vendor Information</h5>
    </div>

    <div class="p-4">
        <form method="POST" action="{{ route('vendors.update', $vendor) }}">
            @csrf
            @method('PUT')

            @include('vendors.partials.form', ['vendor' => $vendor])

            <div class="mt-4">
                <button class="btn btn-orange" type="submit">
                    <i class="bi bi-save me-1"></i>
                    Update Vendor
                </button>

                <a href="{{ route('vendors.index') }}" class="btn btn-outline-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
