<?php

use Faker\Generator as Faker;

$factory->define(App\Image::class, function (Faker $faker) {
    return [
        'name' => $faker->text(20),
        'file' => $faker->imageUrl,
        'enable' => 1,
    ];
});
