<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyVariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('varios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->dropForeign(['cotizacion_id']);
            $table->dropColumn('cotizacion_id');
            $table->integer('obra_id')->unsigned()->nullable();
            $table->foreign('obra_id')->references('id')->on('obras')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('varios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->dropForeign(['obra_id']);
            $table->dropColumn('obra_id');
            $table->integer('cotizacion_id')->unsigned()->nullable();
            $table->foreign('cotizacion_id')->references('id')->on('cotizacions')->onDelete('set null');
        });
    }
}
