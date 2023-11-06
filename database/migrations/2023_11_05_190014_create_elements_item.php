<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementsItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elements_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id');
            $table->foreign('prodi_id')
                ->references('id')
                ->on('prodis')
                ->onDelete('cascade');
            $table->unsignedBigInteger('elements_parent_id');
            $table->foreign('elements_parent_id')
                ->references('id')
                ->on('elements_parent')
                ->onDelete('cascade');
            $table->decimal('score_berkas', 3, 2, true)->nullable();
            $table->decimal('score_hitung', 4, 2, true)->nullable();
            $table->bigInteger('count_berkas')->nullable();
            $table->decimal('min_akreditasi', 3, 2, true)->nullable()->default(0.00);
            $table->enum('status_akreditasi', ['F', 'Y', 'N'])->default('F')->nullable();
            $table->decimal('min_unggul', 3, 2, true)->nullable()->default(0.00);
            $table->enum('status_unggul', ['F', 'Y', 'N'])->default('F')->nullable();
            $table->decimal('min_baik', 3, 2, true)->nullable()->default(0.00);
            $table->enum('status_baik', ['F', 'Y', 'N'])->default('F')->nullable();
            $table->string('ket_auditor', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('elements_item', function (Blueprint $table) {
            //
        });
    }
}
