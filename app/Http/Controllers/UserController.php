<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Modulo;
use App\User;
use App\GuzzleHttpApi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    private $clientHttp;
    function __construct(){
        $this->clientHttp = new GuzzleHttpApi();
        $this->middleware('auth');
    }

     /**
     * Retorna los usuarios activos
     * @return view
     */
    public function users()
    {
        $modules = Modulo::getModules();
        $users   = User::get();

        return view('users/users',['modules'=>$modules, 'users'=>$users]);
    }

    /**
     * Abre la vista para crear un nuevo usuario
     * @return view
     */
    public function newUser()
    {
        if (!Auth::check())
        {
            return view('login');
        }
        $app_id_login = session('app_id_login');
        $modules       = Modulo::getModules();//Get All Modules
        $data          = array();
     

        return view('users/new_user',['modules'=>$modules]);
    }

    /**
     * Crea un nuevo usuario en la bd
     * @param  Request $request
     * @return view
     */
    public function createUser(Request $request)
    {
        DB::beginTransaction();
        try{
            // dd($request->categoria_nombre);
            User::create([
                'numero_documento' => $request->documentNumber,
                'nombre_usuario'   => $request->nameOne.'.'.$request->nameThree,
                'primer_nombre'    => $request->nameOne,
                'segundo_nombre'   => $request->nameTwo,
                'primer_apellido'  => $request->nameThree,
                'segundo_apellido' => $request->nameFour,
                'password'         => Hash::make('123'),
                'email'            => $request->email,
                'activo'           => 1,
                'remember_token'   => str_random(10)
            ]);
            DB::commit();
            return redirect('users');
        }catch(\Throwable $t){
            DB::rollback();
            return redirect('users');
        }
    }

    /**
     * Carga la informacion de un usuario especificado por el id
     * @param  int $id Id de l usuario
     * @return view]
     */
    public function cargarUsuario(int $id)
    {
        $modules       = Modulo::getModules();
        $user          = User::getUserById($id);
        return view('users/edit_user',['modules'=>$modules, 'user'=>$user[0]]);
    }

    /**
     * Edita la informacion de un usuario especificado por id
     * @param  Request $request Datos por POST
     * @return view
     */
    public function editarUsuario(Request $request)
    {

        try{
            $user = User::where('id',$request->id)->update([
                'numero_documento' => $request->documentNumber,
                'nombre_usuario'   => $request->nameOne.'.'.$request->nameThree,
                'primer_nombre'    => $request->nameOne,
                'segundo_nombre'   => $request->nameTwo,
                'primer_apellido'  => $request->nameThree,
                'segundo_apellido' => $request->nameFour,
                // 'password'         => Hash::make($request->password),
                'email'            => $request->email,
                'activo'           => $request->active
            ]);
           return   redirect('users');

        }catch(\Throwable $t){
           return   redirect('users');
        }
    }
}
