<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // non aktifkan beberapa seeder karna bergantung pada id relasi satu sama lain
        $this->call(UserSeeder::class);
        $this->call(StaticPageSeeder::class);
        $this->call(FakultasSeeder::class);
        $this->call(JenjangSeeder::class);
        $this->call(L1Seeder::class);
        $this->call(L2Seeder::class);
        $this->call(L3Seeder::class);
        $this->call(L4Seeder::class);
        $this->call(ProdiSeeder::class);
        $this->call(IndikatorSeeder::class);
        $this->call(PeriodeSeeder::class);
        $this->call(LembagaSeeder::class);
        // $this->call(ScoreSeeder::class);
        // $this->call(TargetSeeder::class);
        // $this->call(ElementSeeder::class);
        // $this->call(BerkasSeeder::class);
    }
}
