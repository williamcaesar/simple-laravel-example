<?php

use App\Category;
use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Product::class, 50)->create()->each(function ($product){
            $product->category_id = factory(Category::class)->create()->id;
        });
    }
}
