<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceDiscount extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'invoice_id',
        'discount_id',
        'percent',
        'amount',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'percent' => 'integer',
        'amount' => 'integer',
    ];

    protected $appends = ['discount_name'];

    public function getDiscountNameAttribute()
    {
        $name = $this->Discount->name;
        unset($this->Discount);
        return $name;
    }

    public function Invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function Discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class, 'discount_id')->withTrashed();
    }
}
