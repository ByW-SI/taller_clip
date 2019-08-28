<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCotizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cotizacions', function (Blueprint $table) {
            $table->double('ganancianeto', 8, 2);
            $table->double('Gananciaenvios', 8, 2);
            $table->double('Ganancia_varios', 8, 2);
            $table->double('Ganancia_manodeobra', 8, 2);
            // $table->double('Ganancia_orden', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cotizacions', function (Blueprint $table) {
            $table->dropColumn('ganancianeto', 'Gananciaenvios', 'Ganancia_varios', 'Ganancia_manodeobra', 'Ganancia_orden');
        });
    }
}
