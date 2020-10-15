<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Usaha;
use Faker\Generator as Faker;

$factory->define(Usaha::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'nama' => $faker->sentence(2),
        'email' => $faker->unique()->safeEmail,
        'alamat' => $faker->sentence(3),
        'deskripsi' => $faker->sentence(5),
    ];
});
