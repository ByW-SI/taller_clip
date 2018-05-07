<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarcosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marcos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->string('clave');
            $table->string('medidas');
            $table->string('espesor');
            $table->string('color');
            $table->string('proveedor');
            $table->float('precio', 8, 2);
            $table->softDeletes();
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
        Schema::dropIfExists('marcos');
    }
}
