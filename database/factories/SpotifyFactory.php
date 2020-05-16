<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Spotify::class, function (Faker $faker) {
    return [
        'user_id' => random_int(1,33),
        'country' => $faker->country,
        'username' => $faker->userName,
        'facebook_ID' => $faker->uuid
    ];
});
