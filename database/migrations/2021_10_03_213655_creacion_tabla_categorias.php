<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionTablaCategorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',191)->comment('Nombre/descripcion de la categoria');
            $table->unsignedInteger('usuario_id_crea')->comment('Id del usuario que crea la categoria');
            $table->unsignedInteger('usuario_id_elimina')->comment('Id del usuario que elimina la categoria')->nullable();
            $table->date('fecha_desactivacion')->comment('Fecha en que el usuario desactiva la categoria')->nullable();
            $table->smallInteger('activo')->comment('1:Activo 0:Inactivo')->default(1);
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
        Schema::dropIfExists('categorias');
    }
}
