<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
	protected $table      = 'modulos';
    public static function getModules()
	{
		$modules=Modulo::where('activo',1)
		                ->orderBy('descripcion', 'asc')
		                ->get();
		return $modules;
	}
}
