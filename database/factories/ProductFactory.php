<?php

/** @var Factory $factory */

use App\Category;
use App\Product;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'value' => rand(1, 50),
        'quantity' => rand(1, 50),
        'category_id' => function () {
            return factory(Category::class)->create()->id;
        },
    ];
});
