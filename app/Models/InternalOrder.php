<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class InternalOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = [
        'table_id',
        'branch_id',
        'waiter_id',
        'discount',
        'full_price',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function Table(): BelongsTo
    {
        return $this->belongsTo(Table::class, 'table_id');
    }

    public function Branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    /** @noinspection PhpUnused */
    public function Waiter(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'waiter_id');
    }

    public function InternalOrderLines(): HasMany
    {
        return $this->hasMany(InternalOrderLine::class, 'internal_order_id');
    }
}
