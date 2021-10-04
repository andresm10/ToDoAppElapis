<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;
use App\User;

class UserController extends Controller
{

    public $successStatus = 200;

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){

        $username =  request('username');
        $password = request('password');
        if (Auth::attempt(['username' => $username, 'password' => $password, 'active' => 1])) {
            $user  = Auth::user();
            $token = $user->createToken($user->username.'-'.date('Y-m-d H:i:s'))->accessToken;
            if($token)
            {
                User::where('id', $user->id)->update(['api_token' => $token]);
            }
            return response()->json(['token' => $token, 'user' => $user->username], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Sin autorizacion'], 401);
        }
    }
/*      -------------------------------------------------------------------------------------------- */
    /**
     * Return all active users
     *
     * @return json
     */
    public function index()
    {
        $users=User::all();
        return response()->json($users, 200);
    }

    /**
     * Return user info
     *
     * @return json
     */
    public function show(Request $request, User $user)
    {
        $user=User::authApi($request->id, $request->token);
        if(isset($user[0]->id)){
            $data['response']=true;
        }else{
            $data['response']=false;

        }

        return response()->json($data);
    }

    /**
     * Return user info
     *
     * @return json
     */
    public function store(Request $request)
    {
        $user = User::setApiNewUser($request);
        return response()->json($user, 201);
    }

    /**
     * Return user info
     *
     * @return json
     */
    public function update(Request $request, User $user)
    {
        $user = User::setApiUser($request, $user);
        return response()->json($user, 200);
    }

    /**
     * Return user info
     *
     * @return json
     */
    public function destroy(User $user, $status = null)
    {
        $user = User::setApiUser($user, $status);
        return response()->json($user, 200);
    }

}
