<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Berkas; // Assuming the model is App\Berkas

$factory->define(Berkas::class, function (Faker $faker) {
    return [
        'element_id' => $faker->randomNumber(), // You might want to use a real reference here
        'prodi_id' => $faker->randomNumber(),
        'l1_id' => $faker->randomNumber(),
        'l2_id' => $faker->randomNumber(),
        'l3_id' => $faker->randomNumber(),
        'l4_id' => $faker->randomNumber(),
        'file_name' => $faker->word . '.pdf', // Assuming it's a file name
        'file' => $faker->url, // Assuming it's a file URL
        'dec' => $faker->text,
        'score' => $faker->randomFloat(2, 0, 1), // decimal(3,2)
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
    ];
});
