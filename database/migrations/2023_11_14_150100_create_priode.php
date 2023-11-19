<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Periode;

class CreatePriode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periode', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('periode_start');
            $table->date('periode_end');
            $table->date('prodi_start')->nullable();
            $table->date('prodi_end')->nullable();
            $table->date('auditor_start')->nullable();
            $table->date('auditor_end')->nullable();
            $table->date('revisi_start')->nullable();
            $table->date('revisi_end')->nullable();
            $table->timestamps();
        });

        $pages = [
            'name' => 'Tahun Ajaran 2023 2024',
            'periode_start' => date('2023-07-01'),
            'periode_end' => date('2024-02-29'),
            'prodi_start' => date('2023-07-01'),
            'prodi_end' => date('2024-02-29'),
            'auditor_start' => date('2023-07-01'),
            'auditor_end' => date('2024-02-29'),
            'revisi_start' => date('2023-07-01'),
            'revisi_end' => date('2024-02-29'),
        ];

        Periode::create($pages);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periode');
    }
}
