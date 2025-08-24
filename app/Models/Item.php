<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $with = [
        'ItemImages',
    ];

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'price' => 'integer',
    ];


    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function ItemImages(): HasMany
    {
        return $this->hasMany(ItemImage::class, 'item_id');
    }

    public function InternalOrderLines(): HasMany
    {
        return $this->hasMany(InternalOrderItem::class, 'item_id');
    }

    /** @noinspection PhpUnused */
    public function OfferItems(): HasMany
    {
        return $this->hasMany(OfferItem::class, 'item_id');
    }
}
