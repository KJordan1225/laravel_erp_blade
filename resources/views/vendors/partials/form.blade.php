<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">
            Vendor Name <span class="required">*</span>
        </label>
        <input 
            type="text" 
            name="name" 
            class="form-control" 
            value="{{ old('name', $vendor->name ?? '') }}" 
            required
        >
    </div>

    <div class="col-md-6">
        <label class="form-label">Contact Person</label>
        <input 
            type="text" 
            name="contact_person" 
            class="form-control" 
            value="{{ old('contact_person', $vendor->contact_person ?? '') }}"
        >
    </div>

    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input 
            type="email" 
            name="email" 
            class="form-control" 
            value="{{ old('email', $vendor->email ?? '') }}"
        >
    </div>

    <div class="col-md-6">
        <label class="form-label">Phone</label>
        <input 
            type="text" 
            name="phone" 
            class="form-control" 
            value="{{ old('phone', $vendor->phone ?? '') }}"
        >
    </div>

    <div class="col-md-8">
        <label class="form-label">Address</label>
        <textarea name="address" class="form-control" rows="4">{{ old('address', $vendor->address ?? '') }}</textarea>
    </div>

    <div class="col-md-4">
        <label class="form-label">
            Status <span class="required">*</span>
        </label>
        <select name="status" class="form-select" required>
            <option value="active" @selected(old('status', $vendor->status ?? 'active') === 'active')>Active</option>
            <option value="inactive" @selected(old('status', $vendor->status ?? 'active') === 'inactive')>Inactive</option>
        </select>
    </div>
</div>
