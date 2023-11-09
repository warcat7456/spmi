<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBerkasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berkas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('element_id');
            $table->foreign('element_id')
                ->references('id')
                ->on('elements')
                ->onDelete('cascade');
            $table->unsignedBigInteger('prodi_id');
            $table->foreign('prodi_id')
                ->references('id')
                ->on('prodis')
                ->onDelete('cascade');
            $table->unsignedBigInteger('l1_id');
            $table->foreign('l1_id')
                ->references('id')
                ->on('l1_s')
                ->onDelete('cascade');
            $table->unsignedBigInteger('l2_id')->nullable();
            $table->foreign('l2_id')
                ->references('id')
                ->on('l2_s')
                ->onDelete('cascade');
            $table->unsignedBigInteger('l3_id')->nullable();
            $table->foreign('l3_id')
                ->references('id')
                ->on('l3_s')
                ->onDelete('cascade');
            $table->unsignedBigInteger('l4_id')->nullable();
            $table->foreign('l4_id')
                ->references('id')
                ->on('l4_s')
                ->onDelete('cascade');
            $table->string('file_name');
            $table->string('file');
            $table->text('dec')->nullable();
            $table->text('catatan_auditor')->nullable();
            $table->decimal('score', 3, 2)->default(0.00);
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
        Schema::dropIfExists('berkas');
    }
}
