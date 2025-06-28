<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use function Laravel\Prompts\table;

class Table extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $appends = [
        'branch_name',
    ];


    protected $fillable = [
        'branch_id',
        'invoice_id',
        'table_number',
        'chair_number',
        'available',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'table_number' => 'integer',
        'chair_number' => 'integer',
        'available' => 'boolean',
    ];


    /** @noinspection PhpUnused */
    public function getBranchNameAttribute()
    {
        $branchName = $this->Branch?->name;
        unset($this->Branch);
        return $branchName;
    }


    public function Branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function Invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'table_id');
    }
}
