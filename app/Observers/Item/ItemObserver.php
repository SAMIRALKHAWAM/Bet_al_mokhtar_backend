<?php

namespace App\Observers\Item;

use App\Models\Item;
use App\Models\ItemImage;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Storage;

class ItemObserver
{
    use FileTrait;

    /**
     * Handle the User "created" event.
     */
    public function created(Item $item): void
    {
        $images = \request()->images;
        foreach ($images as $image) {
            ItemImage::create([
                'item_id' => $item->id,
                'image' => $this->uploadFile($image, 'Items/'),
            ]);
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(Item $item): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(Item $item): void
    {
       $itemImages = $item->ItemImages;
       foreach ($itemImages as $itemImage){
          $this->deleteFile($itemImage->image);
       }
       $itemImages->each->delete();
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(Item $item): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(Item $item): void
    {
        //
    }
}
