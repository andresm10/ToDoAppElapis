<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginUsersController extends Controller
{
    public function showLogin()
	{
	    // show the form
	    return View('login');
	    // return Redirect('login');
	}

	public function doLogin(Request $request)
	{

		// $password=Hash::make('awesome');
		// dd($password);
		// validate the info, create rules for the inputs
		$rules = array(
		    'username'    => 'required', // make sure the email is an actual email
		    'passwordUser' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make($request->all(), $rules);


		if ($validator->fails()) {
		    return Redirect('/')
		        			->withErrors($validator) // send back all errors to the login form
		        			->withInput(Input::except('passwordUser')); // send back the input (not the password) so that we can repopulate the form
		} else {

		    $username = Input::get('username');
		    $password = Input::get('passwordUser');

		    // attempt to do the login
		    if (Auth::attempt(['nombre_usuario' => $username, 'password' => $password, 'activo' => 1])) {
            	$user  = Auth::user();
            	$token = $user->createToken($user->username.'-'.date('Y-m-d H:i:s'))->accessToken;

            	if($token)
	            {
	                User::where('id', $user->id)->update(['api_token' => $token]);
	                session(['app_id_login'=>999]);//identiica el id de la aplicacion de login en la tabla "apps"
	            }

		        return Redirect('actividades');

		    } else {
		        // validation not successful, send back to form
		        return Redirect('/');

		    }

		}
	}

	public function doLogout()
	{
	    Auth::logout(); // log the user out of our application
	    return Redirect('/'); // redirect the user to the login screen
	}
}
