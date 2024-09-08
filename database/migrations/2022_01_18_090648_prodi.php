<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Prodi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prodis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('kode');
            $table->unsignedBigInteger('jenjang_id');
            $table->foreign('jenjang_id')
                ->references('id')
                ->on('jenjangs')
                ->onDelete('cascade');
            $table->unsignedBigInteger('lembaga_id')->default('1');
            $table->foreign('lembaga_id')
                ->references('id')
                ->on('lembaga')
                ->onDelete('cascade');
            $table->unsignedBigInteger('fakultas_id');
            $table->foreign('fakultas_id')
                ->references('id')
                ->on('fakultas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prodis');
    }
}
