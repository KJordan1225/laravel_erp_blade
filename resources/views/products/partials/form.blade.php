<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">
            Product Name <span class="required">*</span>
        </label>
        <input 
            type="text" 
            name="name" 
            class="form-control" 
            value="{{ old('name', $product->name ?? '') }}" 
            required
        >
    </div>

    <div class="col-md-6">
        <label class="form-label">
            SKU <span class="required">*</span>
        </label>
        <input 
            type="text" 
            name="sku" 
            class="form-control" 
            value="{{ old('sku', $product->sku ?? '') }}" 
            required
        >
    </div>

    <div class="col-md-6">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-select">
            <option value="">No Category</option>
            @foreach($categories as $category)
                <option 
                    value="{{ $category->id }}"
                    @selected((string) old('category_id', $product->category_id ?? '') === (string) $category->id)
                >
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Vendor</label>
        <select name="vendor_id" class="form-select">
            <option value="">No Vendor</option>
            @foreach($vendors as $vendor)
                <option 
                    value="{{ $vendor->id }}"
                    @selected((string) old('vendor_id', $product->vendor_id ?? '') === (string) $vendor->id)
                >
                    {{ $vendor->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label">
            Cost Price <span class="required">*</span>
        </label>
        <input 
            type="number" 
            step="0.01" 
            min="0" 
            name="cost_price" 
            class="form-control" 
            value="{{ old('cost_price', $product->cost_price ?? '0.00') }}" 
            required
        >
    </div>

    <div class="col-md-3">
        <label class="form-label">
            Selling Price <span class="required">*</span>
        </label>
        <input 
            type="number" 
            step="0.01" 
            min="0" 
            name="selling_price" 
            class="form-control" 
            value="{{ old('selling_price', $product->selling_price ?? '0.00') }}" 
            required
        >
    </div>

    <div class="col-md-3">
        <label class="form-label">
            Quantity <span class="required">*</span>
        </label>
        <input 
            type="number" 
            min="0" 
            name="quantity" 
            class="form-control" 
            value="{{ old('quantity', $product->quantity ?? 0) }}" 
            required
        >
    </div>

    <div class="col-md-3">
        <label class="form-label">
            Reorder Level <span class="required">*</span>
        </label>
        <input 
            type="number" 
            min="0" 
            name="reorder_level" 
            class="form-control" 
            value="{{ old('reorder_level', $product->reorder_level ?? 0) }}" 
            required
        >
    </div>

    <div class="col-md-4">
        <label class="form-label">
            Status <span class="required">*</span>
        </label>
        <select name="status" class="form-select" required>
            <option value="active" @selected(old('status', $product->status ?? 'active') === 'active')>Active</option>
            <option value="inactive" @selected(old('status', $product->status ?? 'active') === 'inactive')>Inactive</option>
        </select>
    </div>
</div>
