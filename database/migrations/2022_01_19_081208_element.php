<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Element extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id');
            $table->foreign('prodi_id')
                ->references('id')
                ->on('prodis')
                ->onDelete('cascade');
            $table->unsignedBigInteger('l1_id');
            $table->foreign('l1_id')
                ->references('id')
                ->on('kriteria')
                ->onDelete('cascade');
            $table->unsignedBigInteger('l2_id')->nullable();
            $table->foreign('l2_id')
                ->references('id')
                ->on('kriteria')
                ->onDelete('cascade');
            $table->unsignedBigInteger('l3_id')->nullable();
            $table->foreign('l3_id')
                ->references('id')
                ->on('kriteria')
                ->onDelete('cascade');
            $table->unsignedBigInteger('l4_id')->nullable();
            $table->foreign('l4_id')
                ->references('id')
                ->on('kriteria')
                ->onDelete('cascade');
            $table->unsignedBigInteger('indikator_id')->nullable();
            $table->foreign('indikator_id')
                ->references('id')
                ->on('indikators_lam')
                ->onDelete('cascade');
            $table->unsignedBigInteger('periode_id')->default('1');
            $table->foreign('periode_id')
                ->references('id')
                ->on('periode')
                ->onDelete('cascade');
            $table->decimal('bobot', 3, 2, true)->nullable();
            $table->decimal('score_berkas', 3, 2, true)->nullable();
            $table->decimal('score_hitung', 4, 2, true)->nullable();
            $table->bigInteger('count_berkas')->nullable();
            $table->decimal('min_akreditasi', 3, 2, true)->nullable()->default(0.00);
            $table->enum('status_akreditasi', ['F', 'Y', 'N'])->default('F')->nullable();
            $table->decimal('min_unggul', 3, 2, true)->nullable()->default(0.00);
            $table->enum('status_unggul', ['F', 'Y', 'N'])->default('F')->nullable();
            $table->decimal('min_baik', 3, 2, true)->nullable()->default(0.00);
            $table->enum('status_baik', ['F', 'Y', 'N'])->default('F')->nullable();
            $table->text('ket_auditor', 255)->nullable();
            $table->text('deskripsi')->nullable();
            $table->string("element_txt")->nullable();

            $table->decimal('score_auditor', 3, 2, true)->nullable()->default(0.00);
            $table->unique(['prodi_id', 'l1_id', 'l2_id', 'l3_id', 'l4_id', 'indikator_id'], 'unique_index_elements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('elements');
    }
}
