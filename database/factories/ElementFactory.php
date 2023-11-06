<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Element; // Correct the namespace if needed

$factory->define(Element::class, function (Faker $faker) {
    return [
        'prodi_id' => $faker->randomNumber(),
        'l1_id' => $faker->randomNumber(),
        'l2_id' => $faker->randomNumber(),
        'l3_id' => $faker->randomNumber(),
        'l4_id' => $faker->randomNumber(),
        'indikator_id' => $faker->randomNumber(),
        'bobot' => $faker->randomFloat(2, 0, 100),
        'score_berkas' => $faker->randomFloat(2, 0, 100),
        'score_hitung' => $faker->word,
        'count_berkas' => $faker->randomNumber(),
        'min_akreditasi' => $faker->randomFloat(2, 0, 100),
        'status_akreditasi' => $faker->randomElement(['value1', 'value2']),
        'min_unggul' => $faker->randomFloat(2, 0, 100),
        'status_unggul' => $faker->randomElement(['value1', 'value2']),
        'min_baik' => $faker->randomFloat(2, 0, 100),
        'status_baik' => $faker->randomElement(['value1', 'value2']),
        'ket_auditor' => $faker->word,
    ];
});
