<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">
            Name <span class="required">*</span>
        </label>
        <input 
            type="text" 
            name="name" 
            class="form-control" 
            value="{{ old('name', $category->name ?? '') }}" 
            required
        >
    </div>

    <div class="col-md-6">
        <label class="form-label">
            Status <span class="required">*</span>
        </label>
        <select name="status" class="form-select" required>
            <option value="active" @selected(old('status', $category->status ?? 'active') === 'active')>Active</option>
            <option value="inactive" @selected(old('status', $category->status ?? 'active') === 'inactive')>Inactive</option>
        </select>
    </div>

    <div class="col-md-12">
        <label class="form-label">Description</label>
        <input 
            type="text" 
            name="description" 
            class="form-control" 
            value="{{ old('description', $category->description ?? '') }}"
        >
    </div>
</div>
