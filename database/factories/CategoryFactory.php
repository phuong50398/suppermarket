<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => rtrim($faker->text(25), "."),
        'active' => 1,
        'category_group_id' => App\Model\CategoryGroup::pluck('id')->random()
    ];
});
