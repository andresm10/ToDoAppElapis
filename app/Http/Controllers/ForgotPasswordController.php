<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\RecoverPassword;
use DB;

class ForgotPasswordController extends Controller
{
	private $http;
	private $link;

	public function __construct(){
		$this->http = isset($_SERVER['HTTPS'])?$_SERVER['HTTPS']:'http://';
		$this->link = $this->http.$_SERVER['HTTP_HOST'];				
	}

    public function index(){
        return view('/recover_password/forgot_password', ['link'=>$this->link]);
    }

    public function recoverPassword(Request $request){
		$email =$request->email;
		$user  =User::getUserByEmail($email);
    	if(isset($user[0]->id)){
			$user    = $user[0];
			$recover = RecoverPassword::setRecoverPassword($user->id, trim($email));
			if($recover['response']==true){
				// dd($recover['link']);
				$newPassword =str_random(10);
				$userMail = array(
					'email'=>$email,
					'name'=>'Recuperar Cuenta'
				);
				$http = isset($_SERVER['HTTPS'])?$_SERVER['HTTPS']:'http://';
				$port='';
				$link = $http.$_SERVER['HTTP_HOST'].$port;
				$data = array(
					'link' => $link.'/new_password/'.$recover['link'].'/'.$email,
					'name' => $user->primer_nombew.' '.$user->primer_apellido,
					'ip'   => $recover['ip'],
				);
				\Mail::send('/recover_password/forgot_password_design', $data, function ($message) use ($userMail)
				{
					$message->from('andresmajin7@gmail.com', 'Administrador');
					$message->to($userMail['email'], $userMail['name'])->subject('Generar Nueva Contraseña');
				});

    		return Redirect::back()->with(['success'=>'Se ha enviado un correo con un link para generar una nueva contraseña por favor verifica tu bandeja, si no recibes el correo pasados 5 minutos por favor vuelve a intentarlo o revisa en tu bandeja de spam.', 'link'=>$link]);

			}

    	}else{
    		return Redirect::back()->withErrors(['message'=>'No hay ningun usuario reigistrado con el email '.$email.'.']);
    	}
    }

    public function newPassword($link, $email){
    	$linkRecover=RecoverPassword::validateLink($link, $email);

    	$http = isset($_SERVER['HTTPS'])?$_SERVER['HTTPS']:'http://';
		// $port = isset($_SERVER['SERVER_PORT'])?':'.$_SERVER['SERVER_PORT']:'';
		$port='';
		$index = $http.$_SERVER['HTTP_HOST'].$port.'/';

    	if(isset($linkRecover[0]->id)){
			$linkRecover  =$linkRecover[0];
			$fecha        =date("Y-m-d H:i:s");

    		if($fecha>$linkRecover->expiration_date){
    			$data=array('failure'=>'El link para generar una nueva contraseña ya caducó. Para restablecer una contraseña por favor generar un nuevo enlace.', 'newLink'=>$index.'/forgot_password');
    		}else{
    			$data=array('link'=>$link, 'email' =>$email, 'login'=>$index, 'id'=>$linkRecover->id);
    		}
    	}else{
    		$data=array('failure'=>'No se econtró ningun link para restablecer contraseña.', 'newLink'=>$index.'/forgot_password');
    	}
    	// dd($linkRecover, $link, $email);
        return view('/recover_password/new_password',$data);
    }

    public function updatePassword(Request $request){
		$userTable = User::tableName();
		if($request->password!=$request->repeat_password){
    		return Redirect::back()->withErrors(['error'=>'Las contraseñas ingresadas no coinciden, por favor verifiquelas.']);
    		exit;
		}

    	$user = DB::table($userTable)
	                ->where('id', $request->id)
	                ->update([
								'password' => bcrypt($request->password),
	                        ]);

        if($user){
    		return Redirect::back()->with(['success'=>'La contraseña ha sido actualizada correctamente, por favor inicie sesión para comprobarlo.']);
        }else{
    		return Redirect::back()->withErrors(['error'=>'La contraseña no ha podido ser actualizada debido a un error, por favor intente de nuevo.']);
        }
    }

}
