<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposEnvioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_envios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->double('minweight',8,2);
            $table->double('maxweight',8,2);
            $table->double('mindim',8,2);
            $table->string('maxdim',8,2);
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
        Schema::dropIfExists('tipos_envio');
    }
}
