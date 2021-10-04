<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modulo;
use Illuminate\Support\Facades\Auth;
use App\Categoria;
use Illuminate\Support\Facades\DB;

class CategoriasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Carga la vista principal del modulo de categorias
     * @return view
     */
    public function index()
    {
		$modules     = Modulo::getModules();
    	$categorias = $this->getCategoriasPorUsuario();
        return view('categorias/categorias',['modules'=>$modules, 'categorias'=>$categorias]);
    }

    /**
     * Retorna las categorias activas y por usuario
     * @param  int    $usuario_id Id del usuario
     * @return array
     */
    public function getCategoriasPorUsuario()
    {
    	try{
        	$usuarioId    =Auth::user()->id;
			$categorias = Categoria::where(['activo'=>1, 'usuario_id_crea'=>$usuarioId])->orderBy('created_at', 'desc')->get();
		    return $categorias;

    	}catch(\Throwable $t){
			$response=array("error"=>true, "mensaje"=>"No se ha podido obtener las categorias.", "exception"=>$t->getMessage()." Linea: ".$t->getLine());
			return $response;
    	}
    }

    /**
     * Crea una nueva categoria
     * @param  Request $request [Recibo los datos por POST ]
     * @author Wilson Andres Majin
     * @email andresmajin7@gmail.com
     * @date 2021-10-03
     * @return Object Retorna a la vista principal           
     */
    public function nuevaCategoria(Request $request)
    {
        DB::beginTransaction();
    	try{
    		// dd($request->categoria_nombre);
        	$userId    = Auth::user()->id;
        	Categoria::create(['nombre' => $request->categoria_nombre, 'usuario_id_crea' => $userId]);
        	DB::commit();
        	return redirect('categorias');
    	}catch(\Throwable $t){
    		DB::rollback();
			$modules     = Modulo::getModules();
    		$categorias = $this->getCategoriasPorUsuario();
        	return view('categorias/categorias',['modules'=>$modules, 'categorias'=>$categorias, "mensaje"=>"No se ha podido registrar la categoria.", "error_message"=>$t->getMessage()." Linea: ".$t->getLine()]);
    	}
    }

    /**
     * Edita la informacion de una categoria indicada por el id
     * @return
     */
    public function cargarCategoria(int $id)
    {
    	try{
			$modules   = Modulo::getModules();
			$categoria =Categoria::where('id',$id)->select('nombre','id')->first();
        	return view('categorias/editar_categoria',['modules'=>$modules, 'categoria'=>$categoria]);

    	}catch(\Throwable $t){
			$modules    = Modulo::getModules();
			$categorias = $this->getCategoriasPorUsuario();
        	return view('categorias/categorias',['modules'=>$modules, 'categorias'=>$categorias, "mensaje"=>"No se ha podido cargar la categoria", "error_message"=>$t->getMessage()." Linea: ".$t->getLine()]);
    	}
    }

    /**
     * Edita la informacion de una categoria indicada por ID
     * @param  Request $request Recibe los siguientes datos id y nombre
     * @return
     */
    public function editarCategoria(Request $request)
    {
    	try{
			$categorias = Categoria::where('id',$request->id)->update(['nombre'=>$request->categoria_nombre]);
		   return	redirect('categorias');

    	}catch(\Throwable $t){
			$modules    = Modulo::getModules();
			$categorias = $this->getCategoriasPorUsuario();
        	return view('categorias/editar_categoria',['modules'=>$modules, 'categorias'=>$categorias, "error"=>true, "mensaje"=>"No se ha podido editar la categoria.", "exception"=>$t->getMessage()." Linea: ".$t->getLine()]);
    	}
    }

    /**
     * Desactiva una categoria indicada por el id
     * @param  int    $id Id de la categoria que se desea desctivar
     * @return
     */
    public function desactivarCategoria(int $id)
    {
        DB::beginTransaction();
    	try{
			Categoria::where('id',$id)->update(['activo'=>0]);//Desactiva no elimina una actividad
			DB::commit();
		   	return redirect('categorias');

    	}catch(\Throwable $t){
    		DB::rollback();
    		$modules    = Modulo::getModules();
			$categorias = $this->getCategoriasPorUsuario();
        	return view('categorias/categorias',['modules'=>$modules, 'categorias'=>$categorias, "error"=>true, "mensaje"=>"No se ha podido eliminar la categoria.", "exception"=>$t->getMessage()." Linea: ".$t->getLine()]);
    	}
    }

    /**
     * Busca las actividades indicadas en el parametro de busqueda por el campo actividad
     * @author Wilson Andres Majin
     * @email andresmajin7@gmail.com
     * @date 2021-10-03
     * @return ResponseJson
     */
    public function buscarCategorias()
    {
		$categorias=[];
    	try{
			$categoria=Input::get("categoria_nombre");
			if(!empty($categoria)){
				$categorias = Categoria::where('nombre','like', '%'.$categoria.'%')->orderBy('nombre', 'asc')->get();
			}
        	return view('categorias/categorias',['modules'=>$modules, 'categorias'=>$categorias]);

		}catch(\Throwable $t){
			$categorias = $this->getCategoriasPorUsuario();
        	return view('categorias/categorias',['modules'=>$modules, 'categorias'=>$categorias, "error"=>true, "mensaje"=>"No se ha podido obtner las categorias por el filtro de busqueda.", "exception"=>$t->getMessage()." Linea: ".$t->getLine()]);
		}
    }
}
