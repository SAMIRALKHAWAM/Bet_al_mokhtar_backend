<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseInvoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'branch_id',
        'full_price',
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'branch_name'
    ];

    /** @noinspection PhpUnused */
    public function getBranchNameAttribute()
    {
        $name = $this->Branch->name;
        unset($this->Branch);
        return $name;
    }

    public function Branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id')->withTrashed();
    }

    public function PurchaseInvoiceLines(): HasMany
    {
        return $this->hasMany(PurchaseInvoiceLine::class, 'purchase_invoice_id');
    }
}
