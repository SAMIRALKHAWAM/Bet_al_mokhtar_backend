<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class InternalOrderOffer extends Model
{
    use HasFactory,SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = [
        'internal_order_id',
        'offer_id',
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

    public function Offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class, 'offer_id');
    }

}
