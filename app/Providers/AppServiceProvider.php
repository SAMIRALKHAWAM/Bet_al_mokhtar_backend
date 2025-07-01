<?php

namespace App\Providers;

use App\Models\Branch;
use App\Models\Category;
use App\Models\InternalOrder;
use App\Models\Item;
use App\Models\Material;
use App\Models\Offer;
use App\Models\User;
use App\Observers\Branch\BranchObserver;
use App\Observers\Category\CategoryObserver;
use App\Observers\InternalOrder\InternalOrderObserver;
use App\Observers\Item\ItemObserver;
use App\Observers\Material\MaterialObserver;
use App\Observers\Offer\OfferObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Item::observe(ItemObserver::class);
        Category::observe(CategoryObserver::class);
        Offer::observe(OfferObserver::class);
        InternalOrder::observe(InternalOrderObserver::class);
        Branch::observe(BranchObserver::class);
        Material::observe(MaterialObserver::class);
    }
}
