<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion',100)->comment('Nombre del modulo');
            $table->string('min_icon',100)->comment('Icono miniatura del modulo')->nullable();
            $table->string('big_icon',100)->comment('Icono grande del modulo')->nullable();
            $table->string('link',100)->comment('Link de acceso al modulo');
            $table->smallInteger('activo')->comment('Estado del modulo. 0:Inactivo 1:Activo');
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
        Schema::dropIfExists('modules');
    }
}
