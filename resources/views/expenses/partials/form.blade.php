<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">
            Title <span class="required">*</span>
        </label>
        <input 
            type="text" 
            name="title" 
            class="form-control" 
            value="{{ old('title', $expense->title ?? '') }}" 
            required
        >
    </div>

    <div class="col-md-6">
        <label class="form-label">Vendor</label>
        <select name="vendor_id" class="form-select">
            <option value="">No Vendor</option>
            @foreach($vendors as $vendor)
                <option 
                    value="{{ $vendor->id }}"
                    @selected((string) old('vendor_id', $expense->vendor_id ?? '') === (string) $vendor->id)
                >
                    {{ $vendor->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Category</label>
        <input 
            type="text" 
            name="category" 
            class="form-control" 
            value="{{ old('category', $expense->category ?? '') }}"
            placeholder="Office Supplies, Rent, Utilities..."
        >
    </div>

    <div class="col-md-6">
        <label class="form-label">
            Expense Date <span class="required">*</span>
        </label>
        <input 
            type="date" 
            name="expense_date" 
            class="form-control" 
            value="{{ old('expense_date', isset($expense) && $expense ? optional($expense->expense_date)->format('Y-m-d') : date('Y-m-d')) }}" 
            required
        >
    </div>

    <div class="col-md-6">
        <label class="form-label">
            Amount <span class="required">*</span>
        </label>
        <input 
            type="number" 
            name="amount" 
            class="form-control" 
            value="{{ old('amount', $expense->amount ?? '') }}" 
            min="0.01" 
            step="0.01" 
            required
        >
    </div>

    <div class="col-md-6">
        <label class="form-label">
            Payment Method <span class="required">*</span>
        </label>
        <select name="payment_method" class="form-select" required>
            @foreach(['cash', 'check', 'credit_card', 'bank_transfer', 'other'] as $method)
                <option 
                    value="{{ $method }}"
                    @selected(old('payment_method', $expense->payment_method ?? 'cash') === $method)
                >
                    {{ ucwords(str_replace('_', ' ', $method)) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-12">
        <label class="form-label">Notes</label>
        <textarea name="notes" class="form-control" rows="4">{{ old('notes', $expense->notes ?? '') }}</textarea>
    </div>
</div>
