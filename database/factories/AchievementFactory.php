<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Achievement::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1,44),
        'total_points'=> $faker->numberBetween(1,55),
        'total_kms' => $faker->numberBetween(0,333)
    ];
});
