<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SubAct;
use Faker\Generator as Faker;

$factory->define(SubAct::class, function (Faker $faker) {
    return [
        'act_id' => random_int(1, 10),
        'detail' => $faker->sentence(7),
        'idx' => random_int(5, 20),
        'frekuensi' => random_int(1, 10),
    ];
});
