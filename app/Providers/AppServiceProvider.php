<?php

namespace App\Providers;

use App\Models\Inventory;
use App\Observers\InventoryObserver;
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
        Inventory::observe(InventoryObserver::class);
    }
}
