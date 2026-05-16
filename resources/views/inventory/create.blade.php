@extends('layouts.app')

@section('title', 'Adjust Inventory - Blue Orange ERP')
@section('page_title', 'Adjust Inventory')
@section('page_subtitle', 'Increase or decrease product stock')

@section('content')
<div class="row">
    <div class="col-lg-7">
        <div class="erp-card">
            <div class="p-3 border-bottom">
                <h5 class="mb-0 text-primary fw-bold">Inventory Adjustment</h5>
            </div>

            <div class="p-4">
                <form method="POST" action="{{ route('inventory.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">
                            Product <span class="required">*</span>
                        </label>
                        <select name="product_id" class="form-select" required>
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" @selected(old('product_id') == $product->id)>
                                    {{ $product->name }} — Current Qty: {{ $product->quantity }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Adjustment Type <span class="required">*</span>
                        </label>
                        <select name="type" class="form-select" required>
                            <option value="increase" @selected(old('type') === 'increase')>Increase Stock</option>
                            <option value="decrease" @selected(old('type') === 'decrease')>Decrease Stock</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Quantity <span class="required">*</span>
                        </label>
                        <input 
                            type="number" 
                            name="quantity" 
                            class="form-control" 
                            min="1" 
                            value="{{ old('quantity', 1) }}" 
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Reason</label>
                        <textarea name="reason" class="form-control" rows="4">{{ old('reason') }}</textarea>
                    </div>

                    <button class="btn btn-orange" type="submit">
                        <i class="bi bi-save me-1"></i>
                        Save Adjustment
                    </button>

                    <a href="{{ route('inventory.index') }}" class="btn btn-outline-secondary">
                        Cancel
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
