<?php

namespace App\Observers\Offer;

use App\Models\Offer;
use App\Models\OfferBranch;
use App\Models\OfferItem;
use App\Traits\FileTrait;

class OfferObserver
{
    use FileTrait;

    /**
     * Handle the User "created" event.
     */
    public function created(Offer $offer): void
    {
        $offerPrice = 0.00;
        $items = \request()->items;
        $branches = \request()->branches;
        foreach ($items as $item) {
            OfferItem::create([
                'offer_id' => $offer->id,
                'item_id' => $item['item_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
            $offerPrice += $item['quantity'] * $item['price'];
        }

        $offer->update(['price' => $offerPrice]);

        foreach ($branches as $branch) {
            OfferBranch::create([
                'offer_id' => $offer->id,
                'branch_id' => $branch,
            ]);
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(Offer $offer): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(Offer $offer): void
    {
        $offer->OfferItems()->delete();
        $offer->OfferBranches()->delete();
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(Offer $offer): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(Offer $offer): void
    {
        //
    }
}
