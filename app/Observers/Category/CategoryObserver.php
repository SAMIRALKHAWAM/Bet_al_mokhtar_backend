<?php

namespace App\Observers\Category;

use App\Models\Category;
use App\Traits\FileTrait;

class CategoryObserver
{
    use FileTrait;

    /**
     * Handle the User "created" event.
     */
    public function created(Category $category): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(Category $category): void
    {
       //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(Category $category): void
    {
            $this->deleteFile($category->image);
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(Category $category): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        //
    }
}
