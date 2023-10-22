<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Indikator extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indikators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenjang_id');
            $table->foreign('jenjang_id')
                ->references('id')
                ->on('jenjangs')
                ->onDelete('cascade');
            $table->string('dec');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indikators');
    }
}
