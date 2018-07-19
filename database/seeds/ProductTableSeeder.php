<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \App\Product([
            'title' => '鮮奶吐司',
            'price' => 100,
            'unit' => '條',
            'id_product' => 'milk001',
            'description' => '鮮奶口味',
            'notSlice' => true,
            'thickSlice' => true,
            'thinSlice' => true,
        ]);

        $product->save();
    }
}
