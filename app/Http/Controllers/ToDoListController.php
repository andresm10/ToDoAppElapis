<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modulo;
use App\Actividades;
use App\Http\Controllers\CategoriasController AS Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ToDoListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($value='')
    {
		$modules       = Modulo::getModules();
		$objCategorias = new Categoria();
		$categorias    = $objCategorias->getCategoriasPorUsuario();
		$actividades   = $this->getActividades();
        return view('actividades/actividades',['modules'=>$modules, 'actividades'=>$actividades, 'categorias'=>$categorias]);
    }

    /**
     * Crea una nueva actividad
     * @param  Request $request [Recibo los datos por POST ]
     * @author Wilson Andres Majin
     * @email andresmajin7@gmail.com
     * @date 2021-10-02
     * @return Object Retorna a la vista principal           
     */
    public function nuevaActividad(Request $request)
    {
    	try{

        	$userId    = Auth::user()->id;
        	Actividades::create(['actividad' => $request->actividad, 'usuario_id_crea' => $userId, 'categoria_id'=>$request->categoria]);
        	return redirect('actividades');
    	}catch(\Throwable $t){
			$modules     = Modulo::getModules();
			$objCategorias = new Categoria();
			$categorias    = $objCategorias->getCategoriasPorUsuario();
    		$actividades = $this->getActividades();
        	return view('actividades/actividades',['modules'=>$modules, 'actividades'=>$actividades, 'categorias'=>$categorias, "mensaje"=>"No se ha podido registrar la actividad", "error_message"=>$t->getMessage()." Linea: ".$t->getLine()]);
    	}
    }


    /**
     * Edita la informacion de una actividad indicada por el id
     * @return
     */
    public function cargarActividad(int $id)
    {
    	try{
			$modules     = Modulo::getModules();
    		$actividad=Actividades::where('id',$id)->select('actividad','id','categoria_id')->first();
			$objCategorias = new Categoria();
			$categorias    = $objCategorias->getCategoriasPorUsuario();
        	return view('actividades/editar_actividad',['modules'=>$modules, 'actividad'=>$actividad, 'categorias'=>$categorias]);

    	}catch(\Throwable $t){
    		$actividades = $this->getActividades();
    		$objCategorias = new Categoria();
			$categorias    = $objCategorias->getCategoriasPorUsuario();
        	return view('actividades/actividades',['modules'=>$modules, 'actividades'=>$actividades, 'categorias'=>$categorias, "mensaje"=>"No se ha podido cargar la actividad", "error_message"=>$t->getMessage()." Linea: ".$t->getLine()]);
    	}
    }

    /**
     * Edita la informacion de una actividad indicada por ID
     * @param  Request $request Recibe los siguientes datos id y actividad
     * @return
     */
    public function editarActividad(Request $request)
    {
    	try{
			$actividades = Actividades::where('id',$request->id)->update(['actividad'=>$request->actividad, 'categoria_id'=>$request->categoria]);
		   return	redirect('actividades');

    	}catch(\Throwable $t){
			$actividades   = $this->getActividades();
			$modules       = Modulo::getModules();
			$objCategorias = new Categoria();
			$categorias    = $objCategorias->getCategoriasPorUsuario();
        	return view('actividades/editar_actividad',['modules'=>$modules, 'actividades'=>$actividades, 'categorias'=>$categorias, "error"=>true, "mensaje"=>"No se ha podido editar la actividad.", "exception"=>$t->getMessage()." Linea: ".$t->getLine()]);
    	}
    }

    /**
     * Desactiva una actividad indicada por el id
     * @param  int    $id Id de la actividad que se desea desctivar
     * @return
     */
    public function desactivarActividad(int $id)
    {
    	try{
			Actividades::where('id',$id)->update(['activo'=>0]);//Desactiva no elimina una actividad
		   return redirect('actividades');

    	}catch(\Throwable $t){
    		$actividades = $this->getActividades();
        	return view('actividades/actividades',['modules'=>$modules, 'actividades'=>$actividades, "error"=>true, "mensaje"=>"No se ha podido eliminar la actividad.", "exception"=>$t->getMessage()." Linea: ".$t->getLine()]);
    	}
    }


    /**
     * Retorna todas las actividades por usuario y activas
     * @return [type] [description]
     */
    public function getActividades()
    {
    	try{
			$actividades = Actividades::where('activo',1)->orderBy('created_at', 'desc')->get();
        	$usuarioId    = Auth::user()->id;
			$actividades =DB::table('actividades AS a')
                            ->select(
                                'a.id as actividad_id',
                                'a.actividad',
                                'a.estado',
                                'c.id as categoria_id',
                                'c.nombre'
                            )
                            ->join('categorias AS c', 'c.id', '=', 'a.categoria_id')
                            ->where([
                                    'a.usuario_id_crea' => $usuarioId,
                                    'a.activo' => 1
                                ])
                            ->orderBy('a.created_at', 'DESC')
                            ->get();
		    return $actividades;

    	}catch(\Throwable $t){
			$response=array("error"=>true, "mensaje"=>"No se ha podido obtener las actividades.", "exception"=>$t->getMessage()." Linea: ".$t->getLine());
			return $response;
    	}
    }

    /**
     * Busca las actividades indicadas en el parametro de busqueda por el campo actividad
     * @author Wilson Andres Majin
     * @email andresmajin7@gmail.com
     * @date 2021-10-03
     * @return ResponseJson
     */
    public function buscarActividades()
    {
    	try{
			$actividad=Input::get("queryString");
			$actividades=[];
			if(!empty($actividad)){
				$actividades = Actividades::where('actividad','like', '%'.$actividad.'%')->orderBy('actividad', 'asc')->get();
			}
			$response=array("success"=>true, "actividades"=>$actividades);
		    return response()->json($response, 200);

		}catch(\Throwable $t){
			$response=array("error"=>true, "mensaje"=>"No se ha podido obtener las actividades.", "exception"=>$t->getMessage()." Linea: ".$t->getLine());
		    return response()->json($response, 200);
		}
    }
}
