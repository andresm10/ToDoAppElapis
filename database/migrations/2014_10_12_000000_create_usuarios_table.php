<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            //Creacion de la tabla |USERS|
            $table->increments('id');
            $table->string('numero_documento', 20)->unique()->comment('Numero de documento de identificacion');//ERP
            $table->string('nombre_usuario',100)->comment('Nombre de usuario migrado para inicio de sesion');//ERP
            $table->string('primer_nombre',100)->comment('Primer nombre.');//ERP
            $table->string('segundo_nombre',100)->comment('Segundo nombre.')->nullable();//ERP
            $table->string('primer_apellido',100)->comment('Primer apellido');//ERP
            $table->string('segundo_apellido',100)->comment('Segundo apellido')->nullable();//ERP
            $table->string('password',100)->comment('Contrasena de usuario migrada para inicio de sesion');
            $table->string('email',100)->comment('Email del usuario');
            $table->smallInteger('activo')->comment('Estado del usuario. 0:Inactivo 1:Activo')->default(1);
            $table->rememberToken();
            $table->longText('api_token')->nullable();
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
        Schema::dropIfExists('users');
    }
}
