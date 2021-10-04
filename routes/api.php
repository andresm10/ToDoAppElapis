<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Actividades;
use App\Categoria;
// Use App\User;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
	Route::apiResource('users', 'API\UserController');
});

Route::get('buscarActividades', function(){
	try{
		$actividad=Input::get("queryString");
		$userId     =Input::get("user_id");
		$actividades=[];
		if(!empty($actividad)){
			// $actividades = Actividades::where('actividad','like', '%'.$actividad.'%')->orderBy('actividad', 'asc')->get();
			$actividades=Actividades::where(['activo'=>1,'usuario_id_crea'=>$userId])->select('id','actividad','categoria_id')
                ->where(function ($query) use ($actividad){
                    if($actividad!=""){
                        $query->Where('actividad', 'like', '%'.$actividad.'%');

                    }
                })->orderBy('actividad', 'ASC')->get();
		}
		$response=array("success"=>true, "actividades"=>$actividades);
	    return response()->json($response, 200);

	}catch(\Throwable $t){
		$response=array("error"=>true, "mensaje"=>"No se ha podido obtener las actividades.", "exception"=>$t->getMessage()." Linea: ".$t->getLine());
	    return response()->json($response, 200);
	}
});

Route::get('buscarCategorias', function(){
	try{
		$categoria  =Input::get("queryString");
		$userId     =Input::get("user_id");
		$categorias =[];
		if(!empty($categoria)){
			$categorias=Categoria::where(['activo'=>1,'usuario_id_crea'=>$userId])->select('id','nombre')
                ->where(function ($query) use ($categoria){
                    if($categoria!=""){
                        $query->Where('nombre', 'like', '%'.$categoria.'%');

                    }
                })->orderBy('nombre', 'ASC')->get();
		}
		$response=array("success"=>true, "categorias"=>$categorias);
	    return response()->json($response, 200);

	}catch(\Throwable $t){
		$response=array("error"=>true, "mensaje"=>"No se ha podido obtener las categorias.", "exception"=>$t->getMessage()." Linea: ".$t->getLine());
	    return response()->json($response, 200);
	}
});

Route::post('cambiar_estado_actividad', function(Request $request){
	try{

		$estado=Input::post("estado");
		$id=Input::post("id");
		$actividades = Actividades::where('id',$id)->update(['estado'=>$estado]);
		$response=array("success"=>true, 'estado'=>$estado,"id"=>$id);
	    return response()->json($response, 200);

	}catch(\Throwable $t){
		$response=array("error"=>true, "mensaje"=>"No se ha podido finalizar la actividad.", "exception"=>$t->getMessage()." Linea: ".$t->getLine());
	    return response()->json($response, 200);
	}
});

// Route::post('cambiar_estado_actividad', ['uses' => 'ActividadConrtoller@webCheckinConserje']);