<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeForeignKeyToKriteriaInElements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('elements', function (Blueprint $table) {

            $table->dropForeign(['l1_id']);
            $table->dropForeign(['l2_id']);
            $table->dropForeign(['l3_id']);
            $table->dropForeign(['l4_id']);
            $table->dropForeign(['indikator_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('elements', function (Blueprint $table) {
        });
    }
}
