<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">
            Invoice <span class="required">*</span>
        </label>
        <select name="invoice_id" class="form-select" required>
            <option value="">Select Invoice</option>

            @foreach($invoices as $invoice)
                <option 
                    value="{{ $invoice->id }}"
                    @selected((string) old('invoice_id', $payment->invoice_id ?? $selectedInvoice ?? '') === (string) $invoice->id)
                >
                    {{ $invoice->invoice_number }} — {{ $invoice->customer->name ?? 'N/A' }} — Balance: ${{ number_format($invoice->balance_due, 2) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">
            Payment Date <span class="required">*</span>
        </label>
        <input 
            type="date" 
            name="payment_date" 
            class="form-control" 
            value="{{ old('payment_date', isset($payment) && $payment ? optional($payment->payment_date)->format('Y-m-d') : date('Y-m-d')) }}" 
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
            value="{{ old('amount', $payment->amount ?? '') }}" 
            min="0.01" 
            step="0.01" 
            required
        >
    </div>

    <div class="col-md-6">
        <label class="form-label">
            Method <span class="required">*</span>
        </label>
        <select name="method" class="form-select" required>
            @foreach(['cash', 'check', 'credit_card', 'bank_transfer', 'other'] as $method)
                <option 
                    value="{{ $method }}"
                    @selected(old('method', $payment->method ?? 'cash') === $method)
                >
                    {{ ucwords(str_replace('_', ' ', $method)) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Reference Number</label>
        <input 
            type="text" 
            name="reference_number" 
            class="form-control" 
            value="{{ old('reference_number', $payment->reference_number ?? '') }}"
        >
    </div>

    <div class="col-md-12">
        <label class="form-label">Notes</label>
        <textarea name="notes" class="form-control" rows="4">{{ old('notes', $payment->notes ?? '') }}</textarea>
    </div>
</div>
