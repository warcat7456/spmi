<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Lembaga;

class CreateLembaga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lembaga', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_long');
            $table->timestamps();
        });

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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lembaga');
    }
}
