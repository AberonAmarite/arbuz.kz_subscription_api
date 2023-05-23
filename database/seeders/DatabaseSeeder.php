<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\ProductInventory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Product::truncate();
        ProductInventory::truncate();

        $products = ["watermelon", "apple", "oreo", "milk"];

        foreach ($products as $productName) {
            ProductInventory::factory()->create([
                'name' => $productName
            ]);
        }
        foreach ($products as $index => $productName) {
            Product::factory()->create([
                'name' => $productName,
                'product_inventory_id' => $index+1
            ]);
        }
    }
}
