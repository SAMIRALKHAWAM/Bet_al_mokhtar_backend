<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class InternalOrderItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'internal_order_lines';

    protected $primaryKey = 'id';

    protected $fillable = [
        'internal_order_id',
        'item_id',
        'quantity',
        'price',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function InternalOrder(): BelongsTo
    {
        return $this->belongsTo(InternalOrder::class, 'internal_order_id');
    }

    public function Item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
