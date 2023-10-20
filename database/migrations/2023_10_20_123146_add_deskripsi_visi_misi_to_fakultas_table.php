<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeskripsiVisiMisiToFakultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fakultas', function (Blueprint $table) {
            $table->text('deskripsi')->nullable();
            $table->string('visi', 255)->nullable();
            $table->string('misi', 255)->nullable();
            $table->string('foto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fakultas', function (Blueprint $table) {
            $table->dropColumn('deskripsi');
            $table->dropColumn('visi');
            $table->dropColumn('misi');
            $table->dropColumn('foto');
        });
    }
}
