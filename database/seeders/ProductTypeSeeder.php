<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductType;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductType::create([
            'name' => 'BARCODE'
        ]);

        ProductType::create([
            'name' => 'FIFO'
        ]);

        ProductType::create([
            'name' => 'LIFO'
        ]);

        ProductType::create([
            'name' => 'FEFO'
        ]);
    }
}
