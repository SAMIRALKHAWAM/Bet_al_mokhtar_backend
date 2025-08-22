<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WarehouseMaterial extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = ['material_name'];

    protected $fillable = [
        'warehouse_id',
        'material_id',
        'quantity',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /** @noinspection PhpUnused */
    public function getMaterialNameAttribute()
    {
        $material_name = $this->Material->name;
        unset($this->Material);
        return $material_name;
    }

    public function Warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

    public function Material(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

}
