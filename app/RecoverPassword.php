<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class RecoverPassword extends Model
{
	protected $fillable = [
        'user_id'
    ];
    protected static $tableName = 'recover_password';

    /*
    * Return Table Name
    */
    public static function tableName()
    {
        return static::$tableName;
    }

     public static function setRecoverPassword($userId, $email)
    {
		$ip              = $_SERVER['REMOTE_ADDR'];
		$fecha           = date("Y-m-d H:i:s");
		$fechaExpiracion = strtotime('+30 minute',strtotime($fecha));
		$nuevafecha      = date ('Y-m-d H:i:s' , $fechaExpiracion);//fecha de exipiracion del link
		$link            = str_random(30).base64_encode($fecha);//link unico de valdiacion para generar nueva contraseña
		$recover         = DB::table(static::$tableName)->insert(
									            		array(
															'user_id'         => $userId,
															'email'           => $email,
															'ip'              => $ip,
															'request_date'    => $fecha,
															'expiration_date' => $nuevafecha,
															'link'            => $link,
										            ));
		$data=array('response'=>$recover, 'link'=>$link, 'ip'=>$ip);
		return $data;
    }

    public static function validateLink($link, $email){
		$user            = User::tableName();
		$recoverPassword = static::$tableName;
		$linkRecover     = DB::table($user)
	                        ->join($recoverPassword, $user.'.id', '=', $recoverPassword.'.user_id')
	                        ->select($user.'.id', $recoverPassword.'.email', $recoverPassword.'.email', $recoverPassword.'.link', $recoverPassword.'.request_date', $recoverPassword.'.expiration_date')
	                        ->where([$recoverPassword.'.link' => $link, $recoverPassword.'.email' => $email])
	                        ->get();
	    return $linkRecover;
    }
}
