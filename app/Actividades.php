<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividades extends Model
{
	protected $table      = 'actividades';

	protected $fillable = [
        'actividad','usuario_id_crea','categoria_id'
    ];

}
