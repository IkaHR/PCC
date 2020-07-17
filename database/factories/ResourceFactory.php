<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Resource;
use Faker\Generator as Faker;

$factory->define(Resource::class, function (Faker $faker) {
    return [
        'usaha_id' => 1,
        'nama' => $faker->sentence(1),
        'umur' => random_int(1, 2),
        'biaya' => '2,000,000.25',
        'kuantitas' => random_int(1, 2),
        'deskripsi' => $faker->sentence(3),
    ];
});
