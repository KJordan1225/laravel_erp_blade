@extends('layouts.app')

@section('title', 'Add Category - Blue Orange ERP')
@section('page_title', 'Add Category')
@section('page_subtitle', 'Create a new product category')

@section('content')
<div class="erp-card">
    <div class="p-3 border-bottom">
        <h5 class="mb-0 text-primary fw-bold">Category Information</h5>
    </div>

    <div class="p-4">
        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            @include('categories.partials.form', ['category' => null])

            <div class="mt-4">
                <button class="btn btn-orange" type="submit">
                    <i class="bi bi-save me-1"></i>
                    Save Category
                </button>

                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
