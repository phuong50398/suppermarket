<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model\Album;
use Faker\Generator as Faker;

$factory->define(Album::class, function (Faker $faker) {
    return [
        'product_id' => App\Model\Product::pluck('id')->random(),
        'link' => 'http://localhost/suppermarket/custom/images/k'.rand(1,12).'.jpg'
    ];
});
