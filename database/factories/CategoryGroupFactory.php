<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model\CategoryGroup;
use Faker\Generator as Faker;

$factory->define(CategoryGroup::class, function (Faker $faker) {
    return [
        'name' => rtrim($faker->text(25), "."),
        'active' => 1
    ];
});
