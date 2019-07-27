<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model\Producer;
use Faker\Generator as Faker;

$factory->define(Producer::class, function (Faker $faker) {
    return [
       'name' => rtrim($faker->text(15), ".")
    ];
});
