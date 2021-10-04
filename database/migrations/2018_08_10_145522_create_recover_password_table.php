<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecoverPasswordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recover_password', function (Blueprint $table) {
            //Creacion de la tabla |recover_password|
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('Id del usuario');
            $table->string('email')->comment('email de recuperacion del usuario');
            $table->string('ip')->comment('Direccion ip desde donde se hizo la peticion de generar nueva contrasena');
            $table->dateTime('request_date')->comment('Fecha de la solicitud de neuva contrasena');
            $table->dateTime('expiration_date')->comment('Fecha de la caducidad del link para generar una nueva contrasena');
            $table->string('link')->comment('Link para generar la nueva contraseña');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->comment('Referencia de la tabla users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recover_password');
    }
}
