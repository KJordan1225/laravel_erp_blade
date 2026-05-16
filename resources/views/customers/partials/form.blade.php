<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">
            Name <span class="required">*</span>
        </label>
        <input 
            type="text" 
            name="name" 
            class="form-control" 
            value="{{ old('name', $customer->name ?? '') }}" 
            required
        >
    </div>

    <div class="col-md-6">
        <label class="form-label">Company</label>
        <input 
            type="text" 
            name="company" 
            class="form-control" 
            value="{{ old('company', $customer->company ?? '') }}"
        >
    </div>

    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input 
            type="email" 
            name="email" 
            class="form-control" 
            value="{{ old('email', $customer->email ?? '') }}"
        >
    </div>

    <div class="col-md-6">
        <label class="form-label">Phone</label>
        <input 
            type="text" 
            name="phone" 
            class="form-control" 
            value="{{ old('phone', $customer->phone ?? '') }}"
        >
    </div>

    <div class="col-md-6">
        <label class="form-label">Billing Address</label>
        <textarea name="billing_address" class="form-control" rows="4">{{ old('billing_address', $customer->billing_address ?? '') }}</textarea>
    </div>

    <div class="col-md-6">
        <label class="form-label">Shipping Address</label>
        <textarea name="shipping_address" class="form-control" rows="4">{{ old('shipping_address', $customer->shipping_address ?? '') }}</textarea>
    </div>

    <div class="col-md-4">
        <label class="form-label">
            Status <span class="required">*</span>
        </label>
        <select name="status" class="form-select" required>
            <option value="active" @selected(old('status', $customer->status ?? 'active') === 'active')>Active</option>
            <option value="inactive" @selected(old('status', $customer->status ?? 'active') === 'inactive')>Inactive</option>
        </select>
    </div>
</div>
