<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DirectExp;
use Faker\Generator as Faker;

$factory->define(DirectExp::class, function (Faker $faker) {
    return [
        'usaha_id' => 1,
        'nama' => $faker->sentence(1),
        'biaya' => random_int(10000, 1000000),
        'deskripsi' => $faker->sentence(3),
    ];
});
