<?php

use App\Category;
use App\Product;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        factory(Category::class, 50)->create();
    }
}
