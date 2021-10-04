<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionTablaActividades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('actividad',191)->comment('Nombre/descripcion de la actividad a realizar');
            $table->unsignedInteger('usuario_id_crea')->comment('Id del usuario que crea la actividad');
            $table->unsignedInteger('usuario_id_elimina')->comment('Id del usuario que elimina la actividad')->nullable();
            $table->unsignedInteger('categoria_id')->comment('Id de la categirua');
            $table->smallInteger('estado')->comment('Estado de la actividad 0:Pendiente 1:Realizada')->default(0);
            $table->date('fecha_desactivacion')->comment('Fecha en que el usuario desactiva la actividad')->nullable();
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
        Schema::dropIfExists('actividades');
    }
}
