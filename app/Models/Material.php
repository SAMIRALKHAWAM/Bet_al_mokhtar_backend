<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'unit',
        'price',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function WarehouseMaterials(): HasMany
    {
        return $this->hasMany(WarehouseMaterial::class, 'warehouse_id');
    }

    public function PurchaseInvoiceLines(): HasMany
    {
        return $this->hasMany(PurchaseInvoiceLine::class, 'material_id');
    }
}
