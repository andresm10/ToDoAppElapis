<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*20180709*/
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

        // if the validator fails, redirect back to the form

        if ($validator->fails()) {
            return Redirect::to('login')
                            ->withErrors($validator) // send back all errors to the login form
                            ->withInput(Input::except('passwordUser')); // send back the input (not the password) so that we can repopulate the form
        } else {

            // create our user data for the authentication
            /*$userdata = array(
                'email'     => Input::get('email'),
                'password'  => Input::get('password')
            );*/

            $username = Input::get('username');
            $password = Input::get('passwordUser');

            // attempt to do the login
            if (Auth::attempt(['username' => $username, 'password' => $password, 'active' => 1])) {

                // validation successful!
                // redirect them to the secure section or whatever
                // return Redirect::to('secure');
                // for now we'll just echo success (even though echoing in a controller is bad)
                return Redirect::to('user_apps');

            } else {
                // validation not successful, send back to form
                return Redirect::to('login');

            }

        }
    }

    public function doLogout()
    {
        Auth::logout(); // log the user out of our application
        return Redirect::to('login'); // redirect the user to the login screen
    }
}
