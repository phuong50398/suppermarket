<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => rtrim($faker->text(30), "."),
        'price' => rand(10000, 100000),
        'summary' => $faker->paragraphs(2, true),
        'description' => $faker->paragraphs(rand(3,7), true),
        'status' => rand('0','1'),
        'active' =>rand(1,0),
        'images' => 'uploads/k'.rand(1,12).'.jpg',
        'category_id' => App\Model\Category::pluck('id')->random(),
        'provider_id' => App\Model\Provider::pluck('id')->random(),
        'producer_id' => App\Model\Producer::pluck('id')->random()
    ];
});
