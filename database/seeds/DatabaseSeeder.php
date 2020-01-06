<?php
declare(strict_types=1);

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CategoriesTableSeeder::class,
            ProductsTableSeeder::class,
        ]);
    }
}
