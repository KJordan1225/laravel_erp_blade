@extends('layouts.app')

@section('title', 'Edit Product - Blue Orange ERP')
@section('page_title', 'Edit Product')
@section('page_subtitle', 'Update product information')

@section('content')
<div class="erp-card">
    <div class="p-3 border-bottom">
        <h5 class="mb-0 text-primary fw-bold">Product Information</h5>
    </div>

    <div class="p-4">
        <form method="POST" action="{{ route('products.update', $product) }}">
            @csrf
            @method('PUT')

            @include('products.partials.form', [
                'product' => $product,
                'categories' => $categories,
                'vendors' => $vendors,
            ])

            <div class="mt-4">
                <button class="btn btn-orange" type="submit">
                    <i class="bi bi-save me-1"></i>
                    Update Product
                </button>

                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
