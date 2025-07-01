<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'branch_id',
    ];

    protected $appends = ['branch_name','location'];

    /** @noinspection PhpUnused */
    public function getBranchNameAttribute()
    {
        $name = $this->Branch->name;
        unset($this->Branch);
        return $name;
    }

    /** @noinspection PhpUnused */
    public function getLocationAttribute()
    {
        $location = $this->Branch->location;
        unset($this->Branch);
        return $location;
    }

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function Branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function WarehouseMaterials(): HasMany
    {
        return $this->hasMany(WarehouseMaterial::class, 'warehouse_id');
    }
}
