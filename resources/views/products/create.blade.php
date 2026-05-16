@extends('layouts.app')

@section('title', 'Add Product - Blue Orange ERP')
@section('page_title', 'Add Product')
@section('page_subtitle', 'Create a new product')

@section('content')
<div class="erp-card">
    <div class="p-3 border-bottom">
        <h5 class="mb-0 text-primary fw-bold">Product Information</h5>
    </div>

    <div class="p-4">
        <form method="POST" action="{{ route('products.store') }}">
            @csrf

            @include('products.partials.form', [
                'product' => null,
                'categories' => $categories,
                'vendors' => $vendors,
            ])

            <div class="mt-4">
                <button class="btn btn-orange" type="submit">
                    <i class="bi bi-save me-1"></i>
                    Save Product
                </button>

                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
