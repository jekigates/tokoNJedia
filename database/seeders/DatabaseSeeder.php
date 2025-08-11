<?php

namespace Database\Seeders;

use App\Models\FlashSaleProduct;
use App\Models\Merchant;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductPromo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $directories = Storage::disk('public')->directories();

        foreach ($directories as $directory) {
            Storage::disk('public')->deleteDirectory($directory);
        }

        $this->call([
            ShipmentSeeder::class,
            PromoSeeder::class,
        ]);
        User::factory(10)->create();
        Merchant::factory(3)->create();
        ProductCategory::factory(21)->create();
        Product::factory(30)->create();
        ProductPromo::factory(20)->create();
        FlashSaleProduct::factory(5)->create();
    }
}
