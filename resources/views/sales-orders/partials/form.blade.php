<div class="row g-3 mb-4">
    <div class="col-md-4">
        <label class="form-label">
            Customer <span class="required">*</span>
        </label>
        <select name="customer_id" class="form-select" required>
            <option value="">Select Customer</option>
            @foreach($customers as $customer)
                <option 
                    value="{{ $customer->id }}"
                    @selected((string) old('customer_id', $salesOrder->customer_id ?? '') === (string) $customer->id)
                >
                    {{ $customer->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">
            Order Date <span class="required">*</span>
        </label>
        <input 
            type="date" 
            name="order_date" 
            class="form-control" 
            value="{{ old('order_date', isset($salesOrder) && $salesOrder ? optional($salesOrder->order_date)->format('Y-m-d') : date('Y-m-d')) }}" 
            required
        >
    </div>

    <div class="col-md-4">
        <label class="form-label">
            Status <span class="required">*</span>
        </label>
        <select name="status" class="form-select" required>
            @foreach(['draft', 'confirmed', 'shipped', 'cancelled'] as $status)
                <option 
                    value="{{ $status }}"
                    @selected(old('status', $salesOrder->status ?? 'draft') === $status)
                >
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="table-responsive mb-3">
    <table class="table table-bordered align-middle" data-line-items>
        <thead>
            <tr>
                <th>Product</th>
                <th width="150">Quantity</th>
                <th width="180">Unit Price</th>
                <th width="180">Line Total</th>
            </tr>
        </thead>

        <tbody>
            @php
                $items = old('product_id') 
                    ? collect(old('product_id'))->map(function ($productId, $index) {
                        return [
                            'product_id' => $productId,
                            'quantity' => old('quantity')[$index] ?? 1,
                            'unit_price' => old('unit_price')[$index] ?? 0,
                        ];
                    })
                    : (($salesOrder && $salesOrder->items->count()) ? $salesOrder->items : collect([null]));
            @endphp

            @foreach($items as $item)
                <tr data-line-row>
                    <td>
                        <select name="product_id[]" class="form-select" required>
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                @php
                                    $selectedProductId = is_array($item) ? $item['product_id'] : ($item->product_id ?? '');
                                @endphp
                                <option 
                                    value="{{ $product->id }}"
                                    @selected((string) $selectedProductId === (string) $product->id)
                                >
                                    {{ $product->name }} — ${{ number_format($product->selling_price, 2) }}
                                </option>
                            @endforeach
                        </select>
                    </td>

                    <td>
                        <input 
                            type="number" 
                            name="quantity[]" 
                            class="form-control" 
                            value="{{ is_array($item) ? $item['quantity'] : ($item->quantity ?? 1) }}" 
                            min="1" 
                            data-quantity 
                            required
                        >
                    </td>

                    <td>
                        <input 
                            type="number" 
                            name="unit_price[]" 
                            class="form-control" 
                            value="{{ is_array($item) ? $item['unit_price'] : ($item->unit_price ?? 0) }}" 
                            min="0" 
                            step="0.01" 
                            data-price 
                            required
                        >
                    </td>

                    <td>
                        <input 
                            type="number" 
                            class="form-control" 
                            value="{{ is_array($item) ? (($item['quantity'] ?? 1) * ($item['unit_price'] ?? 0)) : ($item->line_total ?? 0) }}" 
                            data-line-total 
                            readonly
                        >
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label">Subtotal</label>
        <input 
            type="number" 
            class="form-control" 
            value="{{ old('subtotal', $salesOrder->subtotal ?? 0) }}" 
            data-subtotal 
            readonly
        >
    </div>

    <div class="col-md-4">
        <label class="form-label">Tax</label>
        <input 
            type="number" 
            name="tax" 
            class="form-control" 
            value="{{ old('tax', $salesOrder->tax ?? 0) }}" 
            step="0.01" 
            min="0" 
            data-tax
        >
    </div>

    <div class="col-md-4">
        <label class="form-label">Discount</label>
        <input 
            type="number" 
            name="discount" 
            class="form-control" 
            value="{{ old('discount', $salesOrder->discount ?? 0) }}" 
            step="0.01" 
            min="0" 
            data-discount
        >
    </div>

    <div class="col-md-4">
        <label class="form-label">Total</label>
        <input 
            type="number" 
            class="form-control fw-bold" 
            value="{{ old('total', $salesOrder->total ?? 0) }}" 
            data-total 
            readonly
        >
    </div>
</div>
