<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Inventory::create([
            'name' => 'Sample Inventory',
            'picture' => 'inventory_images/sample.jpg',
            'area' => '100 sqft',
            'project_id' => 1,
        ]);
    }
}
