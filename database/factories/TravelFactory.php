<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Travel::class, function (Faker $faker) {
    return [
        'departure' => $faker->city,
        'destination' => $faker->city,
        'coordinates_departure' => $faker->latitude .",". $faker->longitude,
        'coordinates_destination' => $faker->latitude .",". $faker->longitude,
        'travel_date' => $faker->dateTimeThisDecade,
        'travel_code' => $faker->uuid,
        'passengers' => $faker->numberBetween(2,5),
        'distance' => $faker->randomFloat(2,30,700),
        'duration' => $faker->numberBetween(3,100),

    ];
});
