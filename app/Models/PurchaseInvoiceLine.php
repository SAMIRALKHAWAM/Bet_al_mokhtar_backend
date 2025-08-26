<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseInvoiceLine extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'purchase_invoice_id',
        'material_id',
        'quantity',
        'price',
        'full_price',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'material_name',
    ];

    /** @noinspection PhpUnused */
    public function getMaterialNameAttribute()
    {
        $name = $this->Material->name;
        unset($this->Material);
        return $name;
    }

    public function PurchaseInvoice(): BelongsTo
    {
        return $this->belongsTo(PurchaseInvoice::class, 'purchase_invoice_id');
    }

    public function Material(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'material_id')->withTrashed();
    }
}
