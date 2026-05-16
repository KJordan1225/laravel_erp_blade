<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    protected $fillable = [
        'vendor_id',
        'title',
        'category',
        'expense_date',
        'amount',
        'payment_method',
        'notes',
    ];

    protected $casts = [
        'expense_date' => 'date',
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
}
