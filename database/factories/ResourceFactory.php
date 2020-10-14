<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Resource;
use Faker\Generator as Faker;

$factory->define(Resource::class, function (Faker $faker) {
    return [
        'usaha_id' => 1,
        'nama' => $faker->sentence(1),
        'umur' => random_int(2, 10),
        'biaya' => random_int(10000, 1000000),
        'kuantitas' => random_int(1, 2),
        'deskripsi' => $faker->sentence(3),
        'jenis' => 1,
        'perawatan' => random_int(10000, 1000000),
    ];
});
