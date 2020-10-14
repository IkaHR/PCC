<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Act;
use Faker\Generator as Faker;

$factory->define(Act::class, function (Faker $faker) {
    return [
        'usaha_id' => 1,
        'nama' => $faker->sentence(3),
    ];
});
