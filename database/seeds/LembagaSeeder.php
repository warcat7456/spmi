<?php

use Illuminate\Database\Seeder;
use App\Lembaga;

class LembagaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'name' => 'BAN-PT',
                'name_long' => 'Badan Akreditasi Nasional Perguruan Tinggi',
            ],
            [
                'name' => 'LAM-DIK',
                'name_long' => 'Lembaga Akreditasi Mandiri Kependidikan',
            ],
            [
                'name' => 'LAM-EMBA',
                'name_long' => 'Lembaga Akreditasi Mandiri Ekonomi Manajemen Bisnis dan Akuntansi',
            ],
        ];

        Lembaga::insert($pages);
    }
}
