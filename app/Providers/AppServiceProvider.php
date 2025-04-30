<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use App\Observers\Category\CategoryObserver;
use App\Observers\Item\ItemObserver;
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
    }
}
