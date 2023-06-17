<?php

namespace App\Observers;

use App\Models\Inventory;
use App\Models\InventoryPriceChange;

class InventoryObserver
{
    /**
     * Handle the Inventory "created" event.
     */
    public function created(Inventory $inventory): void
    {
        //
    }

    /**
     * Handle the Inventory "updated" event.
     */
    public function updated(Inventory $inventory): void
    {
        if ($inventory->isDirty('price')) {
            $oldPrice = $inventory->getOriginal('price');
            $newPrice = $inventory->price;

            $changeType = ($newPrice > $oldPrice) ? 'appreciation' : 'depreciation';

            InventoryPriceChange::create([
                'inventory_id' => $inventory->id,
                'old_price' => $oldPrice,
                'new_price' => $newPrice,
                'change_type' => $changeType,
                'amount' => abs($inventory->price - $inventory->getOriginal('price')),
            ]);
        }
    }

    /**
     * Handle the Inventory "deleted" event.
     */
    public function deleted(Inventory $inventory): void
    {
        //
    }

    /**
     * Handle the Inventory "restored" event.
     */
    public function restored(Inventory $inventory): void
    {
        //
    }

    /**
     * Handle the Inventory "force deleted" event.
     */
    public function forceDeleted(Inventory $inventory): void
    {
        //
    }
}
