<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Element; // Replace with the correct namespace if different
use Faker\Generator as Faker;

$factory->define(App\Element::class, function (Faker $faker) {
    // Read the JSON file and decode it
    $path = base_path('ids.json'); // This gets the file from the root of the Laravel app
    $json = file_get_contents($path);
    $ids = json_decode($json, true);

    // Ensure you have the correct column names for your foreign keys
    return [
        'prodi_id' => $faker->randomElement($ids['Prodi']),
        'l1_id' => $faker->randomElement($ids['L1']),
        'l2_id' => $faker->randomElement($ids['L2']),
        'l3_id' => $faker->randomElement($ids['L3']),
        'l4_id' => $faker->randomElement($ids['L4']),
        'indikator_id' => $faker->randomElement($ids['Indikator']),
        'bobot' => $faker->randomFloat(2, 0, 1),
        'score_berkas' => $faker->randomFloat(2, 0, 1),
        'score_hitung' => $faker->randomFloat(2, 0, 1),
        'count_berkas' => $faker->randomDigit,
        'min_akreditasi' => $faker->randomFloat(2, 0, 1),
        'status_akreditasi' => $faker->randomElement(['F', 'Y', 'N']),
        'min_unggul' => $faker->randomFloat(2, 0, 1),
        'status_unggul' => $faker->randomElement(['F', 'Y', 'N']),
        'min_baik' => $faker->randomFloat(2, 0, 1),
        'status_baik' => $faker->randomElement(['F', 'Y', 'N']),
        'ket_auditor' => $faker->sentence,
        'deskripsi' => $faker->paragraph
    ];
});
