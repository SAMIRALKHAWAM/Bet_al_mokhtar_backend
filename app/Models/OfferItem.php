<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfferItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = [
        'offer_id',
        'item_id',
        'quantity',
        'price',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'price' => 'float',
    ];

    public function Item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function Offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class, 'offer_id');
    }
}
