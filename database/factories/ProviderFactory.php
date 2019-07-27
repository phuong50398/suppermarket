<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model\Provider;
use Faker\Generator as Faker;

$factory->define(Provider::class, function (Faker $faker) {
    return [
        'name' => rtrim($faker->text(15), ".")
    ];
});
