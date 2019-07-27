<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model\CategoryType;
use Faker\Generator as Faker;

$factory->define(CategoryType::class, function (Faker $faker) {
    return [
        'name' => rtrim($faker->text(25), "."),
        'active' => 1,
        'category_id' => App\Model\Category::pluck('id')->random()
    ];
});
