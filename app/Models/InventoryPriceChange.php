<?php

namespace App\Models;

use App\Models\Inventory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryPriceChange extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_id',
        'old_price',
        'new_price',
        'change_type',
        'amount',
    ];
        
    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

}
