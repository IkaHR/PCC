<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DirectExp;
use Faker\Generator as Faker;

$factory->define(DirectExp::class, function (Faker $faker) {
    return [
        'usaha_id' => 1,
        'nama' => $faker->sentence(1),
        'biaya' => '1,500,000',
        'deskripsi' => $faker->sentence(3),
    ];
});
