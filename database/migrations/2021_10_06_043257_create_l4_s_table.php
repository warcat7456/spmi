<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateL4STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l4_s', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('l3_id');
            $table->foreign('l3_id')
                ->references('id')
                ->on('l3_s')
                ->onDelete('cascade');
            $table->unsignedBigInteger('jenjang_id');
            $table->foreign('jenjang_id')
                ->references('id')
                ->on('jenjangs')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('l4_s');
    }
}
