<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyContactosmakenullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contactos_provedor', function (Blueprint $table) {
            $table->string('telefonodir')->nullable()->change();
            $table->string('email1')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contactos_provedor', function (Blueprint $table) {
            //
        });
    }
}
