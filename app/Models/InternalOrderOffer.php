<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class InternalOrderOffer extends Model
{
    use HasFactory, SoftDeletes;

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

    protected $appends = ['offer_name', 'offer_description', 'offer_price'];


    /** @noinspection PhpUnused */
    public function getOfferNameAttribute()
    {
        $name = $this->Offer->name;
        unset($this->Offer);
        return $name;
    }

    /** @noinspection PhpUnused */
    public function getOfferDescriptionAttribute()
    {
        $description = $this->Offer->description;
        unset($this->Offer);
        return $description;
    }

    /** @noinspection PhpUnused */
    public function getOfferPriceAttribute()
    {
        $price = $this->Offer->price;
        unset($this->Offer);
        return $price;
    }

    public function InternalOrder(): BelongsTo
    {
        return $this->belongsTo(InternalOrder::class, 'internal_order_id');
    }

    public function Offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class, 'offer_id')->withTrashed();
    }

}
