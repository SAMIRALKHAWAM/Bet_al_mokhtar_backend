<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $with = ['OfferItems.Item','OfferBranches.Branch'];

    protected $fillable = [
        'branch_id',
        'name',
        'description',
        'price',
        'from_date',
        'to_date',
        'available',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'price' => 'float',
    ];

    /** @noinspection PhpUnused */
    public function OfferItems(): HasMany
    {
        return $this->hasMany(OfferItem::class, 'offer_id')->withTrashed();
    }


    public function OfferBranches(): HasMany
    {
        return $this->hasMany(OfferBranch::class, 'offer_id')->withTrashed();
    }

    /** @noinspection PhpUnused */
    public function InternalOrderOffers(): HasMany
    {
        return $this->hasMany(InternalOrderOffer::class, 'offer_id');
    }
}
