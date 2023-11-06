<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementsParent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elements_parent', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('indikator_id')->nullable();
            $table->foreign('indikator_id')
                ->references('id')
                ->on('indikators')
                ->onDelete('cascade');
            $table->unsignedBigInteger('jenjang_id')->nullable();
            $table->foreign('jenjang_id')
                ->references('id')
                ->on('jenjangs')
                ->onDelete('cascade');
            $table->text('deskripsi')->nullable();

            $table->decimal('bobot', 3, 2, true)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('elements_parent', function (Blueprint $table) {
            //
        });
    }
}
