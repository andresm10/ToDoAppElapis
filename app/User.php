<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use DB;
use App\Quotation;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'primer_nombre','segundo_nombre','primer_apellido','segundo_apellido','numero_documento','nombre_usuario', 'email', 'password', 'activo'
    ];

    protected static $tableName = 'users';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
    * Return Table Name
    */
    public static function tableName()
    {
        return static::$tableName;
    }



    /**
     * Retorna un usuario especificaco por el id
     * @param  int $id Id del usuario
     * @return Object
     */
    public static function getUserById(int $id)
    {
        $user=User::where('id',$id)->get();
        return $user;
    }

  

    public static function getUserByEmail($email)
    {
        $user=User::where(['activo'=>1, 'email'=>$email])->get();
        return $user;
    }

}
